<?php

namespace App\Filament\Resources\SubmissionResource\Pages;

use App\Filament\Resources\SubmissionResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ReviewSubmission extends ViewRecord
{
    protected static string $resource = SubmissionResource::class;

    protected static ?string $breadcrumb = 'Review';
    public static ?string $title = 'Review Submission';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Data Pengaju
                Section::make('Data Pengaju')
                    ->schema([
                        TextEntry::make('member.name')->label('Nama Pengaju'),
                        TextEntry::make('phone_number')->label('Nomor Handphone'),
                        TextEntry::make('education_level')->label('Jenjang Pendidikan'),
                        TextEntry::make('study_program')->label('Program Studi'),
                        TextEntry::make('partner_name')->label('Nama Partner / Mahasiswa'),
                    ])
                    ->columns(2),

                // Informasi Penelitian
                Section::make('Informasi Penelitian')
                    ->schema([
                        TextEntry::make('research_type')->label('Jenis Penelitian'),
                        TextEntry::make('research_field')->label('Bidang Penelitian'),
                        TextEntry::make('research_description')->label('Deskripsi Singkat Penelitian'),
                        TextEntry::make('supervisor_1')->label('Nama Pembimbing 1'),
                        TextEntry::make('supervisor_2')->label('Nama Pembimbing 2'),
                        TextEntry::make('supervisor_3')->label('Nama Pembimbing 3'),
                        TextEntry::make('duration_days')->label('Durasi / (Hari)'),
                        TextEntry::make('research_cost')
                                ->label('Biaya Penelitian')
                                ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-'),
                        TextEntry::make('research_output_plan')->label('Rencana Output Penelitian'),
                        TextEntry::make('previous_research_experience')->label('Pengalaman Penelitian Sebelumnya'),
                        TextEntry::make('activity_plan')->label('Rencana Kegiatan'),
                    ])
                    ->columns(2),

                // Spesifikasi Kebutuhan
                Section::make('Spesifikasi Kebutuhan')
                    ->schema([
                        TextEntry::make('gpu_amount')->label('Jumlah GPU / (GB)'),
                        TextEntry::make('ram_amount')->label('Jumlah RAM / (GB)'),
                        TextEntry::make('storage_amount')->label('Jumlah Storage / (GB)'),
                        TextEntry::make('shared_data')
                                ->label('Menggunakan Data Bersama')
                                ->formatStateUsing(fn ($state) => $state ? 'Ya' : 'Tidak'),
                        TextEntry::make('data_description')->label('Deskripsi Data'),
                    ])
                    ->columns(2),

                // Lampiran Proposal
                Section::make('Lampiran Proposal')
                    ->schema([
                        TextEntry::make('proposal_file')
                            ->label('File Proposal')
                            ->url(fn ($record) => $record->proposal_file ? asset('storage/submissions/proposals/' . $record->proposal_file) : null, shouldOpenInNewTab: true)
                            ->hidden(fn ($state) => blank($state)),

                        TextEntry::make('budget_file')
                            ->label('File Rencana Anggaran')
                            ->url(fn ($record) => $record->budget_file ? asset('storage/submissions/budgets/' . $record->budget_file) : null, shouldOpenInNewTab: true)
                            ->hidden(fn ($state) => blank($state)),

                        TextEntry::make('docker_image')
                            ->label('Link Docker Image')
                            ->url(fn ($state) => $state, shouldOpenInNewTab: true)
                            ->hidden(fn ($state) => blank($state)),
                    ])
                    ->columns(2),


                // Status Pengajuan
                Section::make('Status Pengajuan')
                    ->schema([
                        TextEntry::make('submitted_at')->label('Tanggal Pengajuan')->date(),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->colors([
                                'success' => 'approved',
                                'danger' => 'rejected',
                                'primary' => 'pending',
                                'warning' => 'revision',
                            ]),
                    ])
                    ->columns(2),

                Section::make('Riwayat Revisi')
                    ->schema([
                        TextEntry::make('notes_count')
                            ->label('')
                            ->hidden(fn ($record) => $record->notes()->exists())
                            ->default('Belum ada riwayat revisi.'),

                        RepeatableEntry::make('notes')
                            ->getStateUsing(fn ($record) => $record->notes()->latest()->get())
                            ->hidden(fn ($record) => !$record->notes()->exists())
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Tanggal')
                                    ->dateTime('d M Y H:i'),

                                TextEntry::make('admin.name')
                                    ->label('Admin'),

                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->colors([
                                        'success' => 'approved',
                                        'danger' => 'rejected',
                                        'primary' => 'pending',
                                        'warning' => 'revision',
                                    ]),

                                TextEntry::make('note')
                                    ->label('Catatan Revisi'),
                            ])
                            ->columns(2),
                    ])
                    ->columns(1),
            ]);
    }


    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('updateStatus')
                ->label('Review Submission')
                ->color('primary')
                ->form([
                    \Filament\Forms\Components\Select::make('status')
                        ->label('Pilih Status Baru')
                        ->options([
                            'pending' => 'Belum disetujui',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                            'revision' => 'Revisi',
                        ])
                        ->required(),

                    \Filament\Forms\Components\Textarea::make('note')
                        ->label('Catatan Revisi')
                        ->placeholder('Tulis catatan jika ada revisi atau penolakan')
                        ->rows(4)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $this->record->update([
                        'status' => $data['status'],
                        'is_revised' => $data['status'] === 'revision' ? true : $this->record->is_revised,
                    ]);

                    \App\Models\SubmissionNote::create([
                        'submission_id' => $this->record->id,
                        'admin_id' => auth()->id(),
                        'status' => $data['status'],
                        'note' => $data['note'],
                    ]);

                    Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Status dan catatan revisi berhasil diperbarui.')
                            ->send();
                })
                ->hidden(fn ($record) => $record->status === 'approved'),
        ];
    }


    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Action::make('updateStatus')
    //             ->label('Review Submission')
    //             ->color('primary')
    //             ->form([
    //                 Select::make('status')
    //                     ->label('Pilih Status Baru')
    //                     ->options([
    //                         'pending' => 'Belum disetujui',
    //                         'approved' => 'Disetujui',
    //                         'rejected' => 'Ditolak',
    //                         'revision' => 'Revisi',
    //                     ])
    //                     ->required(),

    //                 \Filament\Forms\Components\Textarea::make('note')
    //                     ->label('Catatan Revisi')
    //                     ->placeholder('Tulis catatan jika ada revisi atau penolakan')
    //                     ->rows(4)
    //                     ->required(),
    //             ])
    //             ->action(function (array $data): void {
    //                 $this->record->update([
    //                     'status' => $data['status'],
    //                 ]);

    //                 // Simpan SubmissionNote
    //                 \App\Models\SubmissionNote::create([
    //                     'submission_id' => $this->record->id,
    //                     'admin_id' => auth()->id(),
    //                     'status' => $data['status'],
    //                     'note' => $data['note'],
    //                 ]);

    //                 $this->notify('success', 'Status dan catatan revisi berhasil diperbarui.');
    //             }),
    //     ];
    // }

}

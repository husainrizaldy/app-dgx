<?php

namespace App\Filament\Resources\SubmissionResource\Pages;

use App\Filament\Resources\SubmissionResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Grid;
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
                        TextEntry::make('member.name')
                                    ->label('Nama Pengaju')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1,2,3])),

                        TextEntry::make('researcher_name_2')->label('Nama Peneliti 2')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [2])),
                        
                        TextEntry::make('phone_number')
                                ->label('Nomor Handphone'),
                        TextEntry::make('education_level')
                                ->label('Jenjang Pendidikan')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1, 2])),
                        TextEntry::make('study_program')
                                ->label('Program Studi')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1, 2])),
                        TextEntry::make('adhoc_admin_name')
                                ->label('Nama Admin Tim AdHoc Internal UG')
                                ->visible(fn ($record) => in_array($record->research_type_id, [3])),
                        TextEntry::make('adhoc_admin_position')
                                ->label('Posisi dalam Tim AdHoc Internal')
                                ->visible(fn ($record) => in_array($record->research_type_id, [3])),

                        TextEntry::make('team_leader_name')
                                ->label('Nama Ketua Tim AdHoc')
                                ->visible(fn ($record) => in_array($record->research_type_id, [3])),
                        TextEntry::make('external_responsible_name')
                                ->label('Nama Penanggung Jawab External')
                                ->visible(fn ($record) => in_array($record->research_type_id, [3])),
                        TextEntry::make('external_institution_name')
                                ->label('Nama Institusi Eksternal')
                                ->visible(fn ($record) => in_array($record->research_type_id, [3])),
                    ])
                    ->columns(2),

                // Informasi Penelitian
                Section::make('Informasi Penelitian')
                    ->schema([
                        TextEntry::make('researchType.name')
                                    ->label('Jenis Penelitian'),

                        TextEntry::make('research_field')
                                    ->label('Bidang Penelitian')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1])),

                        TextEntry::make('research_title')
                                    ->label('Judul Penelitian')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [2])),

                        TextEntry::make('data_description')
                                    ->label('Deskripsi Data'),
                                    
                        TextEntry::make('research_description')
                                    ->label('Deskripsi Singkat Penelitian')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1,2])),

                        TextEntry::make('supervisor_1')->label('Nama Pembimbing 1')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1])),
                        TextEntry::make('supervisor_2')->label('Nama Pembimbing 2')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1])),
                        TextEntry::make('supervisor_3')->label('Nama Pembimbing 3')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1])),

                        

                        TextEntry::make('duration_days')->label('Durasi / (Hari)'),
                        TextEntry::make('research_cost')
                                ->label('Biaya Penelitian')
                                ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-'),

                        TextEntry::make('research_output_plan')->label('Rencana Output Penelitian')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1,2])),

                        TextEntry::make('previous_research_experience')->label('Pengalaman Penelitian Sebelumnya')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [1,2])),

                        TextEntry::make('activity_plan')->label('Rencana Kegiatan'),
                        TextEntry::make('collaboration_activity_form')->label('Bentuk Kegiatan Kerjasama')
                                    ->visible(fn ($record) => in_array($record->research_type_id, [3])),

                        
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
                        TextEntry::make('submission_letter_file')
                            ->label('Surat Pengajuan Penggunaan DGX')
                            ->url(fn ($record) => $record->submission_letter_file
                                ? asset('storage/submissions/' . $record->getFolderByResearchType() . '/' . $record->submission_letter_file)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state)),

                        TextEntry::make('collaboration_document')
                            ->label('Dokumen Kerjasama')
                            ->url(fn ($record) => $record->collaboration_document
                                ? asset('storage/submissions/' . $record->getFolderByResearchType() . '/' . $record->collaboration_document)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state))
                            ->visible(fn ($record) => in_array($record->research_type_id, [3])),

                        TextEntry::make('adhoc_team_document')
                            ->label('Dokumen Tim AdHoc')
                            ->url(fn ($record) => $record->adhoc_team_document
                                ? asset('storage/submissions/' . $record->getFolderByResearchType() . '/' . $record->adhoc_team_document)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state))
                            ->visible(fn ($record) => in_array($record->research_type_id, [3])),

                        TextEntry::make('external_profile_document')
                            ->label('Profil Institusi Eksternal')
                            ->url(fn ($record) => $record->external_profile_document
                                ? asset('storage/submissions/' . $record->getFolderByResearchType() . '/' . $record->external_profile_document)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state))
                            ->visible(fn ($record) => in_array($record->research_type_id, [3])),

                        TextEntry::make('proposal_file')
                            ->label('File Proposal')
                            ->url(fn ($record) => $record->proposal_file
                                ? asset('storage/submissions/' . $record->getFolderByResearchType() . '/' . $record->proposal_file)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state)),

                        TextEntry::make('budget_file')
                            ->label('File Rencana Anggaran')
                            ->url(fn ($record) => $record->budget_file
                                ? asset('storage/submissions/' . $record->getFolderByResearchType() . '/' . $record->budget_file)
                                : null,
                                shouldOpenInNewTab: true
                            )
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

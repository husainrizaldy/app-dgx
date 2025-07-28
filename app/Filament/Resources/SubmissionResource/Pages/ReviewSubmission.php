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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Models\SubmissionNote;
use Illuminate\Support\Facades\Http;

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
                            ->state('Lihat File')
                            ->url(fn ($record) => $record->submission_letter_file
                                ? asset('storage/submissions/' . $record->submission_letter_file)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state)),

                        TextEntry::make('collaboration_document')
                            ->label('Dokumen Kerjasama')
                            ->state('Lihat File')
                            ->url(fn ($record) => $record->collaboration_document
                                ? asset('storage/submissions/' . $record->collaboration_document)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state))
                            ->visible(fn ($record) => in_array($record->research_type_id, [3])),

                        TextEntry::make('adhoc_team_document')
                            ->label('Dokumen Tim AdHoc')
                            ->state('Lihat File')
                            ->url(fn ($record) => $record->adhoc_team_document
                                ? asset('storage/submissions/' . $record->adhoc_team_document)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state))
                            ->visible(fn ($record) => in_array($record->research_type_id, [3])),

                        TextEntry::make('external_profile_document')
                            ->label('Profil Institusi Eksternal')
                            ->state('Lihat File')
                            ->url(fn ($record) => $record->external_profile_document
                                ? asset('storage/submissions/' . $record->external_profile_document)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state))
                            ->visible(fn ($record) => in_array($record->research_type_id, [3])),

                        TextEntry::make('proposal_file')
                            ->label('File Proposal')
                            ->state('Lihat File')
                            ->url(fn ($record) => $record->proposal_file
                                ? asset('storage/submissions/' . $record->proposal_file)
                                : null,
                                shouldOpenInNewTab: true
                            )
                            ->hidden(fn ($state) => blank($state)),

                        TextEntry::make('budget_file')
                            ->label('File Rencana Anggaran')
                            ->state('Lihat File')
                            ->url(fn ($record) => $record->budget_file
                                ? asset('storage/submissions/' . $record->budget_file)
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
            Action::make('updateStatus')
                ->label('Review')
                ->color('primary')
                ->form([
                    Select::make('status')
                        ->label('Pilih Status Baru')
                        ->options([
                            'rejected' => 'Ditolak',
                            'revision' => 'Revisi',
                        ])
                        ->required(),

                    Textarea::make('note')
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

                    SubmissionNote::create([
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
            Action::make('approveDirectly')
                ->label('Approval')
                ->color('success')
                // ->requiresConfirmation()
                ->form(fn ($record) => [
                    TextInput::make('docker_image')
                        ->label('Docker Image Link')
                        ->required()
                        ->default(fn ($record) => $record->docker_image),

                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->email()
                        ->default(fn ($record) => $record->member?->email),
                    
                    Select::make('hari_id')
                        ->label('Hari')
                        ->options($this->getHariOptions())
                        ->required(),
                    
                    TextInput::make('durasi')
                        ->label('Durasi (Hari)')
                        ->numeric()
                        ->minValue(1)
                        ->required()
                        ->suffix('hari'),
                    
                    Select::make('mesin_id')
                        ->label('Pilih Mesin DGX')
                        ->options($this->getMesinOptions())
                        ->required(),

                    Textarea::make('note')
                        ->label('Detail Disetujui')
                        ->placeholder('Detail disetujui...')
                        ->rows(4),
                ])
                ->action(function (array $data): void {
                    $this->record->update([
                        'status' => 'approved',
                    ]);

                    SubmissionNote::create([
                        'submission_id' => $this->record->id,
                        'admin_id' => auth()->id(),
                        'status' => 'approved',
                        'note' => $data['note'] ?? 'Disetujui tanpa catatan tambahan.',
                    ]);

                    // Kirim ke API eksternal
                    try {
                        $response = Http::asForm()
                            ->withoutVerifying()
                            ->post('https://api-dummy.hpc-hs.my.id/dgx/approval', [
                                'DockerImages' => $data['docker_image'],
                                'username' => $data['email'],
                                'id_hari' => $data['hari_id'],
                                'durasi' => $data['durasi'],
                                'id_mesin' => $data['mesin_id'],
                            ]);

                        if ($response->successful() && $response->json('error') === false) {
                            Notification::make()
                                ->success()
                                ->title('Berhasil')
                                ->body('Menyetujui pengajuan & berhasil kirim ke API.')
                                ->send();
                        } else {
                            Notification::make()
                                ->danger()
                                ->title('Gagal Kirim API')
                                ->body('Approval lokal tersimpan, namun gagal kirim ke API.')
                                ->send();
                        }
                    } catch (\Exception $e) {
                        Notification::make()
                            ->danger()
                            ->title('Error')
                            ->body('Gagal kirim ke API: ' . $e->getMessage())
                            ->send();
                    }

                    // Notification::make()
                    //     ->success()
                    //     ->title('Berhasil')
                    //     ->body('Menyetujui pengajuan penelitian.')
                    //     ->send();
                })
                ->hidden(fn ($record) => $record->status === 'approved'),
        ];
    }

    protected function getHariOptions(): array
    {
        try {
            $response = Http::withoutVerifying()->get('https://api-dummy.hpc-hs.my.id/dgx/hari');
            $data = $response->json('data') ?? [];

            return collect($data)->pluck('nama', 'id')->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }

    protected function getMesinOptions(): array
    {
        try {
            $response = Http::withoutVerifying()->get('https://api-dummy.hpc-hs.my.id/dgx/mesin');
            $data = $response->json('data') ?? [];

            return collect($data)->pluck('nama_mesin', 'id_mesin')->toArray();
        } catch (\Throwable $e) {
            return [];
        }
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

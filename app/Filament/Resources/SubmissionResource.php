<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return 'Proposal';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('submitted_at')
                        ->label('Tanggal Pengajuan')
                        ->dateTime('Y-m-d H:i')
                        ->sortable(),
                TextColumn::make('member.email')->label('Email')->searchable()->sortable(),
                TextColumn::make('member.name')->label('Nama Pengaju')->searchable()->sortable(),
                TextColumn::make('researchType.name')->label('Jenis Penelitian')->sortable(),
                TextColumn::make('research_title')->label('Bidang Penelitian')->wrap(),
                TextColumn::make('research_description')->label('Bidang Penelitian')->limit(25)->wrap(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'pending' => 'primary',
                        'revision' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make('review')
                    ->label('Review')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->button(),
            ])
            ->filters([
            SelectFilter::make('status')
                ->label('Status Pengajuan')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'revision' => 'Revision',
                ]),

            SelectFilter::make('research_type_id')
                ->label('Jenis Penelitian')
                ->relationship('researchType', 'name'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubmissions::route('/'),
            'view' => Pages\ReviewSubmission::route('/{record}'), // ViewRecord
        ];
    }

    // Disable create/edit/delete
    public static function canCreate(): bool { return false; }
    public static function canEdit($record): bool { return false; }
    public static function canDelete($record): bool { return false; }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcedureResource\Pages;
use App\Filament\Resources\ProcedureResource\RelationManagers;
use App\Models\Procedure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Storage;

class ProcedureResource extends Resource
{
    protected static ?string $model = Procedure::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationGroup(): ?string
    {
        return 'Procedure and Template';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('research_type_id')
                    ->label('Jenis Penelitian')
                    ->relationship('researchType', 'name')
                    ->required(),

                Select::make('doc_type_id')
                    ->label('Jenis Dokumen')
                    ->relationship('docType', 'name')
                    ->required(),

                FileUpload::make('files')
                    ->label('File Dokumen')
                    ->directory('procedures')
                    ->required()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->maxSize(10240) // max 10MB
                    ->helperText('Hanya file dengan ekstensi .pdf, .doc, atau .docx yang diizinkan. Maksimal ukuran file 10MB.'),

                Placeholder::make('preview_link')
                    ->label('File Dokumen Preview')
                    ->content(function ($get) {
                        $filePath = $get('files');

                        if (is_array($filePath)) {
                            $filePath = array_values($filePath)[0] ?? null;
                        }

                        if (!$filePath) return null;

                        $url = asset('storage/' . $filePath);

                        return new \Illuminate\Support\HtmlString(
                            '<a href="' . $url . '" target="_blank" class="inline-block px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">Lihat Dokumen</a>'
                        );
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('researchType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('docType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('files')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProcedures::route('/'),
            'create' => Pages\CreateProcedure::route('/create'),
            'edit' => Pages\EditProcedure::route('/{record}/edit'),
        ];
    }
}

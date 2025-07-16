<?php

namespace App\Filament\Pages;

use App\Models\Guide;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Notifications\Notification;

class ManageGuide extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.manage-guide';
    protected static ?string $navigationGroup = 'Content';

    public static function getNavigationLabel(): string
    {
        return 'Guide';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public ?Guide $guide = null;

    public array $formData = [];

    public function mount(): void
    {
        $this->guide = Guide::firstOrCreate(
            ['slug' => 'main-guide'],
            [
                'title' => 'Panduan Aplikasi',
                'body' => '',
                'created_by' => auth()->id(),
            ]
        );

        $this->formData = [
            'title' => $this->guide->title,
            'body' => $this->guide->body,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                RichEditor::make('body')
                        ->required()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'h2',
                            'h3',
                            'bulletList',
                            'orderedList',
                            'blockquote',
                            'link',
                            'undo',
                            'redo',
                        ]),
            ])
            ->statePath('formData');
    }

    public function save(): void
    {
        $this->guide->update($this->formData);

        Notification::make()
            ->title('Berhasil')
            ->body('Panduan berhasil diperbarui.')
            ->success()
            ->send();
    }
}

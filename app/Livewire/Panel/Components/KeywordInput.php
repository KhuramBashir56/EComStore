<?php

namespace App\Livewire\Panel\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class KeywordInput extends Component
{
    public $keyword;

    public $keywords = [];

    public function mount($keywords = null)
    {
        $this->reset(['keyword']);
        $this->keywords = $keywords ?? [];
    }

    public function addKeyword()
    {
        if (!in_array($this->keyword, $this->keywords) && count($this->keywords) < 10) {
            $this->validate([
                'keyword' => ['required', 'string', 'max:20'],
            ]);
            $this->keywords[] = trim($this->keyword);
            $this->dispatch('keywordInputUpdated', $this->keywords);
        }
        $this->reset(['keyword']);
    }

    public function removeKeyword($index)
    {
        unset($this->keywords[$index]);
        $this->dispatch('keywordInputUpdated', $this->keywords);
    }

    #[On('resetKeywordInput')]
    public function resetKeywordInput()
    {
        $this->reset(['keyword']);
        $this->keywords = [];
    }
}

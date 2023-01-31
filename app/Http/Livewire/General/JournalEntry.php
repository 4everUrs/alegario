<?php

namespace App\Http\Livewire\General;

use App\Models\JournalEntry as ModelsJournalEntry;
use Livewire\Component;

class JournalEntry extends Component
{
    public $selected_id, $journal_data;
    public function render()
    {
        return view('livewire.general.journal-entry', [
            'journals' => ModelsJournalEntry::with('Entries')->get(),
        ]);
    }
    public function loadModal($id)
    {
        $this->selected_id = $id;
        $this->journal_data = ModelsJournalEntry::find($this->selected_id);
        $this->dispatchBrowserEvent('open-modal');
    }
}

<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;
use App\Models\Transaction;
use Carbon\Carbon;

class Table extends Component
{
    public $filter, $transaction;

    public function mount() {
        $this->transaction = $this->getTransaction()->get();
    }
    public function UpdatedFilter() {
        $filter = session("filter");
        if ($filter == "today") {
            $this->transaction = $this->getTransaction()->where("transaction_date", now()->format("Y-m-d"))->get();
        } else if($filter == "week") {
            $this->transaction = $this->getTransaction()->whereBetween("transaction_date", [now()->startOfWeek()->format("Y-m-d"), now()->endOfWeek()->format("Y-m-d")])->get();
        } else if ($filter == "month") {
            $this->transaction = $this->getTransaction()->whereBetween("transaction_date", [now()->startOfMonth()->format("Y-m-d"), now()->endOfMonth()->format("Y-m-d")])->get();
        } else if ($filter == "year") {
            $this->transaction = $this->getTransaction()->whereBetween("transaction_date", [now()->startOfYear()->format("Y-m-d"), now()->endOfYear()->format("Y-m-d")])->get();
        } else {
            $this->transaction = $this->getTransaction()->get();
        }

        $this->transaction;
    }

    public function getTransaction() {
        return Transaction::Orwhere("status", "completed");
    }

    public function print() {
        session()->put("filter", $this->filter);

        return redirect()->route("report.print");
    }

    public function print_view() {
        $filter = session("filter");
        if ($filter == "today") {
            $trans = $this->getTransaction()->where("transaction_date", now()->format("Y-m-d"))->get();
        } else if($filter == "week") {
            $trans = $this->getTransaction()->whereBetween("transaction_date", [now()->startOfWeek()->format("Y-m-d"), now()->endOfWeek()->format("Y-m-d")])->get();
        } else if ($filter == "month") {
            $trans = $this->getTransaction()->whereBetween("transaction_date", [now()->startOfMonth()->format("Y-m-d"), now()->endOfMonth()->format("Y-m-d")])->get();
        } else if ($filter == "year") {
            $trans = $this->getTransaction()->whereBetween("transaction_date", [now()->startOfYear()->format("Y-m-d"), now()->endOfYear()->format("Y-m-d")])->get();
        } else {
            $trans = $this->getTransaction()->get();
        }

        $total = $trans->sum("total");

        $filter = $filter;
        return view('livewire.admin.report.cetak-pdf' ,compact("trans", "filter", "total"));
    }

    public function render()
    {
        return view('livewire.admin.report.table')->layout('layouts.admin');
    }
}

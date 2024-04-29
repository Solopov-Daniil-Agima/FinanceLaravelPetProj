<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $flatData = new Collection();

        $flatData->push([
            'Данные пользователя:', 'Имя пользователя - ' . $this->data['name'], 'Почта пользователя - ' . $this->data['email'], 'Текущий баланс пользователя - ' . $this->data['balance'],
        ]);

        if (!empty($this->data['transactions_plus']) || !empty($this->data['transactions_minus'])) {
            $flatData->push([
                'Транзакции',
            ]);

            $flatData->push([
                'Transaction ID', 'Sum', 'Status', 'Created At',
            ]);
        }

        if (!empty($this->data['transactions_plus'])) {
            $flatData->push([
                'История доходов',
            ]);

            foreach ($this->data['transactions_plus'] as $transaction) {
                $flatData->push($this->transformTransaction($transaction));
            }
        }

        if (!empty($this->data['transactions_plus'])) {
            $flatData->push([
                'История расходов',
            ]);

            foreach ($this->data['transactions_minus'] as $transaction) {
                $flatData->push($this->transformTransaction($transaction));
            }
        }

        return $flatData;
    }

    protected function transformTransaction($transaction)
    {
        return [
            $transaction['id'],
            $transaction['sum'],
            $transaction['status'],
            $transaction['created_at'],
        ];
    }

    public function headings(): array
    {
        return [
            'Transaction ID', 'Sum', 'Status', 'Created At',
        ];
    }
}

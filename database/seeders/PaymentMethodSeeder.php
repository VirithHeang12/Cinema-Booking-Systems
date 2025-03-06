<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'name'          => 'Credit Card',
                'description'   => 'A plastic card issued by a bank or business that allows the holder to purchase goods or services on credit.'
            ],
            [
                'name'          => 'Debit Card',
                'description'   => 'A card issued by a bank allowing the holder to transfer money electronically to another bank account when making a purchase.'
            ],
            [
                'name'          => 'Bank Transfer',
                'description'   => 'A method of transferring money from one bank account to another.'
            ],
            [
                'name'          => 'Cash',
                'description'   => 'Money in coins or notes, as distinct from checks, money orders, or credit.'
            ],
            [
                'name'          => 'E-Wallet',
                'description'   => 'An electronic device or online service that allows an individual to make electronic transactions.'
            ],
            [
                'name'          => 'Cryptocurrency',
                'description'   => 'A digital or virtual currency that uses cryptography for security.'
            ],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            \App\Models\PaymentMethod::create($paymentMethod);
        }
    }
}

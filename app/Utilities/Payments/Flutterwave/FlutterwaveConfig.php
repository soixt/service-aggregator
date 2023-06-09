<?php

namespace App\Utilities\Payments\Flutterwave;

class FlutterwaveConfig {
    public static function default () : array {
        return [
            'payment_options' => [
                'account', 'card',
                'banktransfer',
                'mobilemoneyrwanda',
                'mobilemoneyzambia',
                'mobilemoneyuganda',
                'mobilemoneyghana',
                'mobilemoneyfranco',
                'mobilemoneytanzania',
                'ussd',
                'credit',
                'mpesa',
                'barter',
                'payattitude',
                '1voucher',
                'paga',
                'qr'
            ],
            'fraudBanks' => [
                'Zinternet Nigera Limited',
                'FortisMobile',
                'Yes Microfinance Bank',
                'Xslnce Microfinance Bank',
                'VTNetworks',
                'Visa Microfinance Bank',
                'Virtue Microfinance Bank',
                'Verite Microfinance Bank',
                'UNN MFB',
                'Unical Microfinance Bank',
                'Uniben Microfinance Bank',
                'Stellas Microfinance Bank',
                'Stanford Microfinance Bak',
                'Stanbic IBTC @ease wallet',
                'Sparkle',
                'Seed Capital Microfinance Bank',
                'SafeTrust',
                'Richway Microfinance Bank',
                'RenMoney Microfinance Bank',
                'Reliance Microfinance Bank',
                'Regent Microfinance Bank',
                'Refuge Mortgage Bank',
                'Rand merchant Bank',
                'Quickfund Microfinance Bank',
                'Platinum Mortgage Bank',
                'Petra Microfinance Bank',
                'Personal Trust Microfinance Bank',
                'Pennywise Microfinance Bank',
                'PecanTrust Microfinance Bank',
                'Paycom',
                'PayAttitude Online',
                'PatrickGold Microfinance Bank',
                'Parralex Microfinance bank',
                'Parkway-ReadyCash',
                'Page Financials',
                'Paga',
                'One Finance',
                'Omoluabi savings and loans',
                'Olabisi Onabanjo University Microfinance Bank',
                'Okpoga Microfinance Bank',
                'Ohafia Microfinance Bank',
                'NIP Virtual Bank',
                'Mutual Benefits Microfinance Bank',
                'MoneyBox',
                'Mkudi',
                'Mint-Finex MICROFINANCE BANK',
                'Midland Microfinance Bank',
                'Malachy Microfinance Bank',
                'Mainstreet Microfinance Bank',
                'Lovonus Microfinance Bank',
                'Lagos Building Investment Company',
                'La  Fayette Microfinance Bank',
                'Kuda',
                'KCMB Microfinance Bank',
                'Intellifin',
                'Innovectives Kesh',
                'Infinity Trust Mortgage Bank',
                'Infinity Microfinance Bank',
                'Imperial Homes Mortgage Bank',
                'Imo State Microfinance Bank',
                'Hackman Microfinance Bank',
                'ChamsMobile',
                'Grooming Microfinance Bank',
                'Gowans Microfinance Bank',
                'GoMoney',
                'Gateway Mortgage Bank',
                'Gashua Microfinance Bank',
                'Futo Microfinance Bank',
                'Fullrange Microfinance Bank',
                'Flutterwave Technology Solutions Limited',
                'FFS Microfinace Bank',
                'FET',
                'FCMB Easy Account',
                'FBNQuest Merchant Bank',
                'FAST Microfinance Bank',
                'Eyowo MFB',
                'eTranzact',
                'Eso-E Microfinance Bank',
                'Esan Microfinance Bank',
                'Ecobank Xpress Account',
                'e-Barcs Microfinance Bank',
                'Eartholeum',
                'Contec Global Infotech Limited (NowNow)',
                'Consumer Microfinance Bank',
                'CIT Microfinance Bank',
                'Chikum Microfinance Bank',
                'CEMCS Microfinance Bank',
                'Cellulant',
                'Bowen Microfinance Bank',
                'AMML MFB',
                'AMJU Unique Microfinance Bank',
                'Al-Hayat Microfinance Bank',
                'Adeyemi College Staff Microfinance Bank',
                'Addosser Microfinance Bank'
            ]
        ];
    }
}
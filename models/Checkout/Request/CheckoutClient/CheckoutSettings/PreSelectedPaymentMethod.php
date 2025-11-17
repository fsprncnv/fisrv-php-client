<?php

namespace Fisrv\Models;

enum PreSelectedPaymentMethod: string
{
    case ABSA = 'Absa';
    case ALIPAY = 'Alipay';
    case ALIPAYPLUS = 'AlipayPlus';
    case POSTFINANCE = 'Apmwalleepostfinance';
    case APPLE = 'Applepay';
    case BANCONTACT = 'BancontactQR';
    case BIZUM = 'Bizum';
    case BLIK = 'Blik';
    case CARDS = 'Cards';
    case CLICKTOPAY = 'Clicktopay';
    case EPS = 'EPS';
    case GIROPAY = 'Giropay';
    case GOOGLEPAY = 'Googlepay';
    case IDEAL = 'Ideal';
    case NATWEST = 'Natwestpayit';
    case PAYPAL = 'PayPal';
    case SAMSUNG = 'Samsungpay';
    case SEPA = 'Sepadd';
    case SOFORT = 'Sofort';
}

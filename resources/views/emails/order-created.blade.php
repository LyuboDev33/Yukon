<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>Потвърждение на поръчка {{ $order->order_number }} | ЮКОН ООД</title>
</head>

<body style="margin:0;padding:0;background:#f4f5f6;color:#28343b;font-family:Arial,Helvetica,sans-serif;">
    @php
        $money = fn($value) => number_format((float) $value, 2, '.', ' ') . ' €';
        $discountAmount = max(
            0,
            round((float) $order->subtotal - (float) $order->total + (float) ($order->delivery_price ?? 0), 2),
        );
        $courierName = $order->courier === 'econt' ? 'Еконт' : ($order->courier === 'speedy' ? 'Speedy' : 'куриер');
    @endphp
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f4f5f6;">
        <tr>
            <td align="center" style="padding:28px 12px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
                    style="max-width:650px;background:#ffffff;border-radius:18px;overflow:hidden;">
                    <tr>
                        <td style="background:#283940;padding:30px 32px;text-align:center;">
                            <div style="font-size:25px;font-weight:800;letter-spacing:2px;color:#ffffff;">ЮКОН <span
                                    style="color:#e8a34c;">ООД</span></div>
                            <div style="margin-top:7px;font-size:12px;letter-spacing:1px;color:#cbd4d6;">КАШОНИ И
                                ОПАКОВКИ ОТ ВЕЛПАПЕ</div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:34px 30px 24px;">
                            <div
                                style="width:60px;height:60px;line-height:60px;background:#f9eddd;border-radius:50%;color:#a96921;font-size:32px;font-weight:bold;">
                                ✓</div>
                            <h1 style="margin:19px 0 10px;font-size:27px;line-height:1.3;color:#283940;">Благодарим Ви
                                за поръчката!</h1>
                            <p style="margin:0;font-size:15px;line-height:1.7;color:#68757a;">Здравейте,
                                {{ $order->first_name }}! Получихме Вашата поръчка и ще се свържем с Вас при
                                необходимост.</p>
                            <div
                                style="display:inline-block;margin-top:20px;padding:12px 19px;background:#f8f4ef;border:1px solid #f0e4d6;border-radius:9px;font-size:14px;color:#5b6266;">
                                Поръчка № <strong style="color:#a96921;">{{ $order->order_number }}</strong></div>
                            <p style="margin:12px 0 0;font-size:12px;color:#899398;">Дата:
                                {{ $order->created_at?->format('d.m.Y H:i') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 30px 22px;">
                            <h2 style="font-size:18px;margin:0 0 15px;color:#283940;">Продукти в поръчката</h2>
                            @foreach ($orderProducts as $product)
                                @php
                                    $unitPrice = (float) $product->final_price;
                                    $originalPrice = (float) $product->price;
                                    $quantity = (int) $product->quantity;
                                    $lineTotal = round($unitPrice * $quantity, 2);
                                @endphp
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                    style="border:1px solid #e9ecee;border-radius:12px;margin-bottom:12px;">
                                    <tr>
                                        <td width="78" valign="top" style="padding:15px 10px 15px 15px;">
                                            @if ($product->product_image)
                                                <img src="{{ asset('assets/images/products/' . $product->product_image) }}"
                                                    alt="{{ $product->product_name }}" width="70"
                                                    style="display:block;width:70px;height:auto;border:0;border-radius:8px;">
                                            @endif
                                        </td>
                                        <td valign="top" style="padding:15px 8px;">
                                            <div style="font-size:15px;font-weight:700;line-height:1.5;color:#283940;">
                                                {{ $product->product_name }}</div>
                                            <div style="font-size:13px;line-height:1.8;color:#66747a;">Количество:
                                                <strong>{{ $quantity }} бр.</strong></div>
                                            <div style="font-size:13px;line-height:1.8;color:#66747a;">Ед. цена:
                                                <strong>{{ $money($unitPrice) }}</strong></div>
                                            @if ($originalPrice > $unitPrice)
                                                <div style="font-size:12px;line-height:1.8;color:#a96921;">Преди
                                                    отстъпка: <s>{{ $money($originalPrice) }}</s>
                                                    @if ((float) $product->discount > 0)
                                                        · -{{ $product->discount }}%
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td valign="middle" align="right"
                                            style="padding:15px 15px 15px 5px;white-space:nowrap;">
                                            <strong
                                                style="font-size:15px;color:#283940;">{{ $money($lineTotal) }}</strong>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 30px 24px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                style="background:#f7f8f8;border-radius:12px;">
                                <tr>
                                    <td style="padding:17px 18px 10px;font-size:14px;color:#66747a;">Междинна сума</td>
                                    <td align="right" style="padding:17px 18px 10px;font-size:14px;color:#283940;">
                                        {{ $money($order->subtotal) }}</td>
                                </tr>
                                @if ($discountAmount > 0)
                                    <tr>
                                        <td style="padding:7px 18px;font-size:14px;color:#66747a;">Промо отстъпка
                                            @if ($order->promo_code)
                                                ({{ $order->promo_code }})
                                            @endif
                                        </td>
                                        <td align="right" style="padding:7px 18px;font-size:14px;color:#a96921;">
                                            -{{ $money($discountAmount) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="padding:7px 18px 16px;font-size:14px;color:#66747a;">Доставка</td>
                                    <td align="right" style="padding:7px 18px 16px;font-size:13px;color:#66747a;">
                                        {{ (float) ($order->delivery_price ?? 0) > 0 ? $money($order->delivery_price) : 'Уточнява се допълнително' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:0 18px;">
                                        <div style="height:1px;background:#e2e7e9;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:17px 18px 20px;font-size:16px;font-weight:700;color:#283940;">
                                        Общо за поръчката</td>
                                    <td align="right"
                                        style="padding:17px 18px 20px;font-size:22px;font-weight:800;color:#a96921;">
                                        {{ $money($order->total) }}</td>
                                </tr>
                            </table>
                            <p style="margin:9px 0 0;font-size:12px;line-height:1.6;color:#879196;">Ако доставката
                                предстои да бъде уточнена, тя не е включена в показаната обща сума.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 30px 24px;">
                            <h2 style="font-size:18px;margin:0 0 12px;color:#283940;">Данни за доставка</h2>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                style="border:1px solid #e9ecee;border-radius:12px;">
                                <tr>
                                    <td style="padding:17px 19px;font-size:14px;line-height:1.9;color:#5c6a70;">
                                        <strong style="color:#283940;">Получател:</strong> {{ $order->first_name }}
                                        {{ $order->last_name }}<br>
                                        <strong style="color:#283940;">Телефон:</strong> {{ $order->phone }}<br>
                                        <strong style="color:#283940;">Имейл:</strong> {{ $order->email }}<br>
                                        <strong style="color:#283940;">Доставка:</strong>
                                        {{ $order->delivery_method === 'office' ? 'До офис на ' . $courierName : 'До личен адрес' }}<br>
                                        @if ($order->delivery_method === 'office')
                                            <strong style="color:#283940;">Офис:</strong> {{ $order->office_list }}<br>
                                        @else
                                            <strong style="color:#283940;">Град:</strong> {{ $order->city }}<br>
                                            <strong style="color:#283940;">Адрес:</strong>
                                            {{ $order->personal_address }}<br>
                                        @endif
                                        <strong style="color:#283940;">Плащане:</strong>
                                        {{ $order->payment_option === 'cash_on_delivery' ? 'При получаване' : ($order->payment_option === 'unicredit' ? 'UniCredit' : $order->payment_option) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @if ($order->request_invoice)
                        <tr>
                            <td style="padding:0 30px 24px;">
                                <h2 style="font-size:18px;margin:0 0 12px;color:#283940;">Данни за фактура</h2>
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                    style="border:1px solid #e9ecee;border-radius:12px;">
                                    <tr>
                                        <td style="padding:17px 19px;font-size:14px;line-height:1.9;color:#5c6a70;">
                                            <strong style="color:#283940;">Фирма:</strong>
                                            {{ $order->company_name }}<br>
                                            <strong style="color:#283940;">МОЛ:</strong> {{ $order->company_mol }}<br>
                                            <strong style="color:#283940;">ЕИК / Булстат:</strong>
                                            {{ $order->company_bulstat }}<br>
                                            <strong style="color:#283940;">Адрес:</strong>
                                            {{ $order->company_address }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td align="center" style="background:#f8f4ef;padding:26px 30px;">
                            <p style="margin:0 0 8px;font-size:15px;font-weight:700;color:#283940;">Имате въпроси за
                                поръчката?</p>
                            <p style="margin:0;font-size:13px;line-height:1.8;color:#68757a;">Свържете се с нас на <a
                                    href="mailto:yukon_kn@abv.bg"
                                    style="color:#a96921;text-decoration:none;">yukon_kn@abv.bg</a> или <a
                                    href="tel:+359888886103" style="color:#a96921;text-decoration:none;">+359 888 886
                                    103</a>.</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"
                            style="padding:20px 30px 26px;background:#283940;color:#cbd4d6;font-size:12px;line-height:1.8;">
                            © {{ date('Y') }} ЮКОН ООД · Кюстендил<br>
                            Благодарим Ви, че избрахте нас!
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

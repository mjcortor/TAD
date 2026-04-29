<x-mail::message>
# ¡Gracias por tu pedido en Reposa+!

Hola {{ $order->user->name }},

Tu pedido #{{ $order->id }} ha sido confirmado con éxito. 

**Resumen del Pedido:**
| Producto | Cantidad | Precio |
| :--- | :---: | :--- |
@foreach ($order->orderItems as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | {{ number_format($item->price, 2) }}€ |
@endforeach
| **Total** | | **{{ number_format($order->total_price, 2) }}€** |

Nos pondremos en marcha para que recibas tus almohadas lo antes posible.

<x-mail::button :url="config('app.url') . '/orders'">
Ver mi pedido
</x-mail::button>

Gracias,<br>
El equipo de {{ config('app.name') }}
</x-mail::message>

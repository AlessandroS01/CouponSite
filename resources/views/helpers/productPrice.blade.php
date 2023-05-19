<!-- la direttiva @can all'atto della condizione della vista genera ciò che sta scritto prima dell'@else
    solo se il gate che si passa come parametro risulta verificato -->
@can('show-discount')
    <p class="price"> {{ number_format($product->getPrice($product->discounted), 2, ',', '.') }} € </p>
    @if ($product->discounted == 1)
        <p class="discprice"> Valore <del>{{ number_format($product->getPrice(false), 2, ',', '.') }} €</del><br>
        Sconto {{ $product->discountPerc }}%</p>
    @endif
@else
    <p class="price"> {{ number_format($product->getPrice(false), 2, ',', '.') }} € </p>
@endcan

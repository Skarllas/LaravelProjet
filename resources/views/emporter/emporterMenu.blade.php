<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($menus as $menu)
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{ Storage::url($menu->image) }}" alt="Image" />
                    <div class="px-6 py-4">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                            {{ $menu->name }}</h4>
                        <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <span class="text-xl text-green-600">${{ $menu->price }}</span>
                    </div>
                    <form wire:submit.prevent="addToCart({{ $menus}})" action="{{ route('emporter.emporterMenu') }}" method="POST">
                        @csrf
                        <input wire:model="quantity.{{ $menus}}" type="number"
                               class="text-sm sm:text-base px-2 pr-2 rounded-lg border border-gray-400 py-1 focus:outline-none focus:border-blue-400"
                               style="width: 50px"/>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Add to Cart
                        </button>
                    </form>


                </div>
            @endforeach



            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach(Cart::content() as $row) :?>

                        <tr>
                            <td>
                                <p><strong><?php echo $row->name; ?></strong></p>
                                <p><?php echo ($row->options->has('size') ? $row->options->size : ''); ?></p>
                            </td>
                            <td><input type="text" value="<?php echo $row->qty; ?>"></td>
                            <td>$<?php echo $row->price; ?></td>
                            <td>$<?php echo $row->total; ?></td>
                        </tr>

                    <?php endforeach;?>

                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Subtotal</td>
                        <td><?php echo Cart::subtotal(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Tax</td>
                        <td><?php echo Cart::tax(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Total</td>
                        <td><?php echo Cart::total(); ?></td>
                    </tr>
                </tfoot>
         </table>
        </div>
    </div>
</x-guest-layout>

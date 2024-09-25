<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Components\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart - MyEcommerce')]
class CartPage extends Component
{

    public $cart_items = [];
    public $grand_total ;

    public function mount(){

        $this->cart_items =CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($product_id){

        $this->cart_items = CartManagement::removeItemFromCart($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count',total_amount:count($this->cart_items))->to(Navbar::class);
    }

    public function incrementQty($product_id){
        $this->cart_items = CartManagement::increamentQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count',total_amount:count($this->cart_items))->to(Navbar::class);
    }

    public function decrementQty($product_id){
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count',total_amount:count($this->cart_items))->to(Navbar::class);
    }
    

    public function render()
    {
        
        return view('livewire.cart-page');
    }
}

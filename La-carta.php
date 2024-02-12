<?php session_start();
class Cart {
    protected $cart_contents = array();
    
    public function __construct(){
        // obtener el array del carrito de la sesión
        $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
		if ($this->cart_contents === NULL){
			$this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
		}
    }
    
    /**
	 * Devuelve toda la matriz del carrito
	 * @param	bool
	 * @return	array
	 */
	public function contents(){
		// reordenar primero el más nuevo
		$cart = array_reverse($this->cart_contents);

		//elimína para que no creen problemas al mostrar la tabla de carritos
		unset($cart['total_items']);
		unset($cart['cart_total']);

		return $cart;
	}
    
    /**
	 * Obtener artículo del carrito: Devuelve los detalles de un artículo específico del carrito
	 * @param	string	$row_id
	 * @return	array
	 */
	public function get_item($row_id){
		return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR ! isset($this->cart_contents[$row_id]))
			? FALSE
			: $this->cart_contents[$row_id];
	}
    
    /**
	 * Total Artículos: Devuelve el recuento total de artículos
	 * @return	int
	 */
	public function total_items(){
		return $this->cart_contents['total_items'];
	}
    
    /**
	 * Total de la cesta: Devuelve el precio total
	 * @return	int
	 */
	public function total(){
		return $this->cart_contents['cart_total'];
	}
    
    /**
	 * Introducir artículos en el carrito y guardarlo en la sesión
	 * @param	array
	 * @return	bool
	 */
	public function insert($item = array()){
		if(!is_array($item) OR count($item) === 0){
			return FALSE;
		}else{
            if(!isset($item['id'], $item['name'], $item['price'], $item['qty'])){
                return FALSE;
            }else{
                // preparar la cantidad
                $item['qty'] = (float) $item['qty'];
                if($item['qty'] == 0){
                    return FALSE;
                }
                // preparar el precio
                $item['price'] = (float) $item['price'];
                // crear un identificador único para el artículo que se inserta en el carrito
                $rowid = md5($item['id']);
                // obtener la cantidad si ya existe y añadirla
                $old_qty = isset($this->cart_contents[$rowid]['qty']) ? (int) $this->cart_contents[$rowid]['qty'] : 0;
                // re-create the entry with unique identifier and updated quantity
                $item['rowid'] = $rowid;
                $item['qty'] += $old_qty;
                $this->cart_contents[$rowid] = $item;
                
                // volver a crear la entrada con el identificador único y la cantidad actualizada
                if($this->save_cart()){
                    return isset($rowid) ? $rowid : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
	}
    
    /**
	 * Update the cart
	 * @param	array
	 * @return	bool
	 */
	public function update($item = array()){
		if (!is_array($item) OR count($item) === 0){
			return FALSE;
		}else{
			if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])){
				return FALSE;
			}else{
				if(isset($item['qty'])){
					$item['qty'] = (float) $item['qty'];
					// remove the item from the cart, if quantity is zero
					if ($item['qty'] == 0){
						unset($this->cart_contents[$item['rowid']]);
						return TRUE;
					}
				}
				

				$keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item));
				// PREPARA EL PRECIO
				if(isset($item['price'])){
					$item['price'] = (float) $item['price'];
				}
				foreach(array_diff($keys, array('id', 'name')) as $key){
					$this->cart_contents[$item['rowid']][$key] = $item[$key];
				}
				// GUARDA DATOS DEL CARRITO
				$this->save_cart();
				return TRUE;
			}
		}
	}
    
    /**
	 * Guardar el array del carrito en la sesión
	 * @return	bool
	 */
	protected function save_cart(){
		$this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
		foreach ($this->cart_contents as $key => $val){
			if(!is_array($val) OR !isset($val['price'], $val['qty'])){
				continue;
			}
	 
			$this->cart_contents['cart_total'] += ($val['price'] * $val['qty']);
			$this->cart_contents['total_items'] += $val['qty'];
			$this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['price'] * $this->cart_contents[$key]['qty']);
		}
		
		// si el carro está vacío, eliminarlo de la sesión
		if(count($this->cart_contents) <= 2){
			unset($_SESSION['cart_contents']);
			return FALSE;
		}else{
			$_SESSION['cart_contents'] = $this->cart_contents;
			return TRUE;
		}
    }
    
    /**
	 * ELIMINAR ITEMS DEL CARRITO DE COMPRAS
	 * @param	int
	 * @return	bool
	 */
	 public function remove($row_id){
		// unset & save
		unset($this->cart_contents[$row_id]);
		$this->save_cart();
		return TRUE;
	 }
     
    /**
	 * 	Destruye el carrito: Vacía el carro y destruye la sesión
	 * @return	void
	 */
	public function destroy(){
		$this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
		unset($_SESSION['cart_contents']);
	}
}
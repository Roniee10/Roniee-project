
<?php if (!empty($_GET['action'])) {
    $productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
    $quantity = isset($_POST['quantity'])
        ? htmlspecialchars($_POST['quantity'])
        : '';

    switch ($_GET['action']) {
        case 'add':
            if (!empty($quantity)) {
                $stmt = $db->prepare('SELECT * FROM dishes WHERE d_id = ?');
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $productDetails = $stmt->get_result()->fetch_object();
                $itemArray = [
                    $productDetails->d_id => [
                        'title' => $productDetails->title,
                        'd_id' => $productDetails->d_id,
                        'quantity' => $quantity,
                        'price' => $productDetails->price,
                    ],
                ];

                // Check if the requested quantity is available in stock
                if ($productDetails->stock >= $quantity) {
                    if (!empty($_SESSION['cart_item'])) {
                        // Check if the product is already in the cart
                        if (
                            in_array(
                                $productDetails->d_id,
                                array_keys($_SESSION['cart_item'])
                            )
                        ) {
                            foreach ($_SESSION['cart_item'] as $k => $v) {
                                if ($productDetails->d_id == $k) {
                                    if (
                                        empty(
                                            $_SESSION['cart_item'][$k][
                                                'quantity'
                                            ]
                                        )
                                    ) {
                                        $_SESSION['cart_item'][$k][
                                            'quantity'
                                        ] = 0;
                                    }
                                    $_SESSION['cart_item'][$k][
                                        'quantity'
                                    ] += $quantity;
                                }
                            }
                        } else {
                            $_SESSION['cart_item'] =
                                $_SESSION['cart_item'] + $itemArray;
                        }
                    } else {
                        $_SESSION['cart_item'] = $itemArray;
                    }

                    // Reduce the stock quantity accordingly
                    $stmt = $db->prepare(
                        'UPDATE dishes SET stock = stock - ? WHERE d_id = ?'
                    );
                    $stmt->bind_param('ii', $quantity, $productId);
                    $stmt->execute();
                } else {
                    $temp_msg =
                        'Sorry! There are only ' .
                        $productDetails->stock .
                        ' item(s) in stock'; ?>
					<script type="text/javascript">alert('<?php echo $temp_msg; ?>');</script>
					<?php
                }
            }
            break;

        case 'remove':
            if (!empty($_SESSION['cart_item'])) {
                foreach ($_SESSION['cart_item'] as $k => $v) {
                    if ($productId == $v['d_id']) {
                        unset($_SESSION['cart_item'][$k]);
                    }
                }
            }
            break;

        case 'empty':
            unset($_SESSION['cart_item']);
            break;

        case 'check':
            header('location:checkout.php');
            break;
    }
}

?>

<?php
$pageTitle = "Order - Radiohead Archive";
include 'includes/db.php';
include 'includes/header.php';


if(!isset($_SESSION['role']))
{
    header("Location: auth.php");
    exit();
}


// if($_SESSION['role'] == 'admin')
// {
//     header("Location: dashboard.php");
//     exit();
// }


$userId = $_SESSION['user_id'];


$orderMessage = "";

if(isset($_GET['success']))
{
    $orderMessage = "Order placed successfully. We will contact you through your e-mail";
}

if(isset($_POST['place_order']))
{
    $albumId = intval($_POST['album_id']);
    $quantity = intval($_POST['quantity']);

    if($quantity < 1)
    {
        $orderMessage = "Invalid quantity.";
    }
    else
    {
        $query = "INSERT INTO orders(user_id, album_id, quantity)
        VALUES ('$userId', '$albumId', '$quantity')";
        mysqli_query($conn, $query);

        header("Location: order.php?success=1");

        exit();
    }
}

if(isset($_POST['delete_order']))
{
    $orderId = $_POST['order_id'];
    $userId = $_SESSION['user_id'];
    $deleteQuery = "DELETE FROM orders
    WHERE id = '$orderId'
    AND user_id = '$userId'";
    mysqli_query($conn, $deleteQuery);
    header("Location: order.php");
    exit();
}

$albumsQuery = "SELECT * FROM albums";
$albumsResult = mysqli_query($conn, $albumsQuery);


$orderHistoryQuery = "SELECT orders.*, albums.title
FROM orders JOIN albums ON orders.album_id = albums.id
WHERE user_id ='$userId'
ORDER BY order_date DESC";

$orderHistoryResult = mysqli_query($conn, $orderHistoryQuery);

?>

<main id="order-page" >
    <section>
        <h2>Order Vinyl</h2>
        <p>Browse available Radiohead vinyl records</p>
        <p><?php echo $orderMessage; ?></p>

        <table>
            <tr>
                <th>Album</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Order</th>
            </tr>

            <?php while($album = mysqli_fetch_assoc($albumsResult))
            { ?>
            <tr>
                <td><?php echo $album['title']; ?></td>
                <td><?php echo $album['release_year']; ?></td>
                <td><?php echo $album['genre']; ?></td>
                <td>$<?php echo $album['price']; ?></td>
                <form method="POST">
                    <td>
                        <input type="hidden" name="album_id" value=" <?php echo $album['id']; ?>">
                        <input type="number" name="quantity" min="1" value="1">
                    </td>
                    <td><button type="submit" name="place_order">Order</button></td>
                </form>
            </tr>
            <?php } ?>
        </table>

        <h2>Your Orders</h2>
        <table>
            <tr>
                <th>Album</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>

            <?php while($order = mysqli_fetch_assoc($orderHistoryResult))
            {
            ?>

            <tr>
                <td><?php echo $order['title']; ?></td>
                <td><?php echo $order['quantity']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <button type="submit" name="delete_order">Delete</button>
                    </form>
                </td>
            </tr>

            <?php
            }
            ?>
        </table>
    </section>
</main>

<?php
include 'includes/footer.php';
?>
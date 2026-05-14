<?php
$pageTitle = "Dashboard - Radiohead Archive";
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_SESSION['role'])) {
    header("Location: auth.php");
    exit();
}

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];

    $deleteQuery = "DELETE FROM users WHERE id = '$userId'";
    mysqli_query($conn, $deleteQuery);

    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['update_price'])) {
    $albumId = $_POST['album_id'];
    $newPrice = $_POST['price'];

    $query = "UPDATE albums SET price = '$newPrice' WHERE id = '$albumId'";
    mysqli_query($conn, $query);

    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];

    $query = "UPDATE orders SET status = '$status' WHERE id = '$orderId'";
    mysqli_query($conn, $query);

    header("Location: dashboard.php");
    exit();
}

$usersResult = mysqli_query($conn, "SELECT * FROM users");
$albumsResult = mysqli_query($conn, "SELECT * FROM albums");

$ordersQuery =
"SELECT orders.*, users.username, users.email, albums.title
FROM orders
JOIN users ON orders.user_id = users.id
JOIN albums ON orders.album_id = albums.id
WHERE orders.status = 'Pending'
ORDER BY order_date DESC";

$ordersResult = mysqli_query($conn, $ordersQuery);

?>

<main id="dashboard-page">
    <h2>Admin Dashboard</h2>
    <h3>Users</h3>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Delete</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($usersResult)) { ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <?php if ($user['role'] != 'admin') { ?>
                        <form method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete_user">Delete</button>
                        </form>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h3>Album Prices</h3>
    <table>
        <tr>
            <th>Album</th>
            <th>Price</th>
            <th>Update</th>
        </tr>

        <?php while ($album = mysqli_fetch_assoc($albumsResult)) { ?>
            <tr>
                <td><?php echo $album['title']; ?></td>
                <form method="POST">
                    <td>
                        <input type="hidden" name="album_id" value="<?php echo $album['id']; ?>">
                        <input type="number" name="price" step="0.01" value="<?php echo $album['price']; ?>" required>
                    </td>
                    <td>
                        <button type="submit" name="update_price">Update</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>

    <h3>Orders</h3>
    <table>
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Album</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Update</th>
        </tr>

        <?php while ($order = mysqli_fetch_assoc($ordersResult)) { ?>
            <tr>
                <td><?php echo $order['username']; ?></td>
                <td><?php echo $order['email']; ?></td>
                <td><?php echo $order['title']; ?></td>
                <td><?php echo $order['quantity']; ?></td>
                <form method="POST">
                    <td>
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <select name="status">

                            <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>
                                Pending
                            </option>
                            <option value="Completed" <?php if ($order['status'] == 'Completed') echo 'selected'; ?>>
                                Completed
                            </option>
                            <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>
                                Cancelled
                            </option>

                        </select>
                    </td>
                    <td>
                        <button type="submit" name="update_status">Update</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</main>

<?php include 'includes/footer.php'; ?>
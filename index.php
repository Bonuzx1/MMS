
<?php
include('includes/header.php');

if (!$user->isUserAdmin())
{
    if (isset($_GET['profile']))
    {
        include 'includes/profile.php';
    }elseif (isset($_GET['assignment']))
    {
        include "includes/assignment.php";
    }
}else {
    $message = "";
    if (isset($_GET['dashboard'])) {
        include('includes/dashboard.php');
    } elseif (isset($_GET['staff'])) {
        include 'includes/staff.php';
        $act = $_GET['staff'];
        if ($_GET['staff'] == "removed") {

            echo '<script> alert("Successfully ' . $act . ' staff")</script>';

        }
        if ($_GET['staff'] == "activated") {
            echo '<script> alert("Successfully ' . $act . ' staff")</script>';
        }
        if ($_GET['staff'] == "deleted") {
            echo '<script> alert("Successfully ' . $act . ' staff")</script>';
        }

    } elseif (isset($_GET['edit-staff'])) {
        include 'includes/edit-staff.php';
    } elseif (isset($_GET['remove-staff'])) {
        $id = $_GET['remove-staff'];
        $result = $user->updateone('staff', 'active', '0', 'staffid', $id);
        if ($result) {
            echo '<script> window.location.href="index.php?staff=removed";</script>';


        } else {
            echo '<script> alert("Cannot delete ' . $id . '")</script>';

        }
        // $name = $row['name'];
    } elseif (isset($_GET['delete-staff'])) {
        $id = $_GET['delete-staff'];
        $result = $user->updateone('staff', 'active', '0', 'staffid', $id);
        $result = $user->updateone('staff', 'isdeleted', '1', 'staffid', $id);
        if ($result) {
            echo '<script> window.location.href="index.php?staff=deleted";</script>';


        } else {
            echo '<script> alert("Cannot delete ' . $id . '")</script>';

        }
        // $name = $row['name'];
    } elseif (isset($_GET['activate-staff'])) {
        $id = $_GET['activate-staff'];
        $result = $user->updateone('staff', 'active', '1', 'staffid', $id);
        if ($result) {
            echo '<script> window.location.href="index.php?staff=activated";</script>';


        } else {
            echo '<script> alert("Cannot delete ' . $id . '")</script>';

        }
        // $name = $row['name'];
    } elseif (isset($_GET['setting'])) {
        include 'includes/setting.php';
    } elseif (isset($_GET['asset'])) {
        include 'includes/asset.php';
    } elseif (isset($_GET['location'])) {
        include 'includes/location.php';
    } elseif (isset($_GET['maintain'])) {
        include 'includes/maintain.php';
    } elseif (isset($_GET['customer'])) {
        include 'includes/customer.php';
    } elseif (isset($_GET['dept'])) {
        include 'includes/dept.php';
    } elseif (isset($_GET['supply'])) {
        include 'includes/supply.php';
    } elseif (isset($_GET['order'])) {
        include 'includes/workorder.php';
    } elseif (isset($_GET['order-tbl'])) {
        include 'includes/order-tbl.php';
    } elseif (isset($_GET['areport'])) {
        include 'includes/areport.php';
    } elseif (isset($_GET['sreport'])) {
        include 'includes/sreport.php';
    } elseif (isset($_GET['creport'])) {
        include 'includes/creport.php';
    } elseif (isset($_GET['request'])) {
        include "includes/request.php";
    }

    else
    {
        include "includes/404.php";
    }
}
include('includes/footer.php');


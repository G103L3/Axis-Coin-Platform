<!DOCTYPE html>
<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
if(!check_session($conn)){
    header('location:index.php');
    exit;
}
?>
<head>
    <script src="js/data_include.js"></script>
</head>
<div class="row">
    <div class="col-xl-3 col-md-4">
        <div data-include="settings_sidebar"></div>
    </div>
    <div class="col-xl-9 col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Linked Account or Card</h4>
            </div>
            <div class="card-body">
                <div class="form">
                    <ul class="linked_account">
                        <li>
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex">
                                        <span class="me-3"><i class="fa fa-bank"></i></span>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0 mb-1">Bank of America</h5>
                                            <p>Bank **************5421</p>
                                        </div>
                                        <div class="edit-option">
                                            <a href="#"><i class="fa fa-eye"></i></a>
                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                            <a href="#"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="verify">
                                        <div class="verified">
                                            <span><i class="la la-check"></i></span>
                                            <a href="#">Verified</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-9">
                                    <div class="media my-4">
                                        <span class="me-3"><i class="fa fa-cc-mastercard"></i></span>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0 mb-1">Master Card</h5>
                                            <p>Credit Card *********5478</p>
                                        </div>
                                        <div class="edit-option">
                                            <a href="#"><i class="fa fa-eye"></i></a>
                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                            <a href="#"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="verify">
                                        <div class="verified">
                                            <span><i class="la la-check"></i></span>
                                            <a href="#">Verified</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-9">
                                    <div class="d-flex">
                                        <span class="me-3"><i class="fa fa-credit-card"></i></span>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0 mb-1">Debit Card</h5>
                                            <p>Prepaid Card *********5478</p>
                                        </div>
                                        <div class="edit-option">
                                            <a href="#"><i class="fa fa-eye"></i></a>
                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                            <a href="#"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="verify">
                                        <div class="not-verify">
                                            <span><i class="la la-close"></i></span>
                                            <a href="#">Not verified</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="mt-5">
                        <a href="verify-step-5.php" class="btn btn-primary px-4 me-3">Add Bank
                            Account</a>
                        <a href="verify-step-1.php" class="btn btn-success px-4">Add Debit
                            Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 







echo "


<div>
    <div>
        <div class='card'>
            <div class='card-body'>
                <div >
                    <h5 style='margin: 0 50px 0 0'>P.O.N: ".$_POST['id']."</h5>
                    <h4>Office: ".$_POST['office']."</h4>
                </div>
            </div>
        </div>
       
    </div>
    <br>
    <div style='display:flex; width:100%'>
        <div style=' width:70%'>
            <div class='card'>
                <div class='card-header'>
                <h5 class='card-title'>List of Items</h5>
                </div>
                <div class='card-body'>
                    <h5 class='card-title'></h5>
                    <table class='table ttable ' style='width:100%'>
                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>Description</th>
                            <th scope='col'>Total Qty</th>
                            <th scope='col'>Arrived</th>
                            <th scope='col'>Status</th>
                        </tr>
                    </thead>
                    <tbody >
                        <tr>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div style=' width:50%; display:none'>
            <div class='card'>
                <div class='card-header'>
                    <h5 class='card-title'> Confirm Stock Arrived</h5>
                </div>
                <div class='card-body'>
                   
                    <p class='card-text'>With supporting text below as a natural lead-in to additional content.</p>
                    <a href='#' class='btn btn-primary'>Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
        
    <!---------------------------------------->
    <div>
    </div>
</div>




";






?>
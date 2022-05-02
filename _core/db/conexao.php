<?php

function connectDB(){
    return mysqli_connect(
        "localhost",
        "root",
        "",
        "estudo",
        "3306"
    );
}
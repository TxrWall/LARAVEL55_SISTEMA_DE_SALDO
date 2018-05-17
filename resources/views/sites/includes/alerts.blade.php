<?php
/**
 * Created by PhpStorm.
 * User: Wallace
 * Date: 17/05/2018
 * Time: 00:19
 */

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<?php
    function maiusculo($t){
        return mb_convert_case( $t,  MB_CASE_UPPER, 'UTF-8');
    }
?>
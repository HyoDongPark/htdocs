<?php
/**
 * Created by PhpStorm.
 * User: Siro
 * Date: 2017-11-07
 * Time: 오후 3:28
 */

class fallExection extends Exception {

}

class exceTest {

    public function exec() {
        try {
            throw new fallExection();
        } catch (fallExection $e) {
            echo "fallExection<br>";
            throw $e;
        } catch (Exception $e) {
            echo "Exception<br>";
        } finally {
            echo "Finally <br>";
        }
    }
}

$obj = new exceTest();
$obj->exec();
<?php

/* 
 * The MIT License
 *
 * Copyright 2016 Pierre HUBERT.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Connected devices list
 * 
 * @author Pierre HUBERT
 */

/**
 * Include project config
 */
include("config.php");

/**
 * Get lease file content
 */
$leaseFileContent = file_get_contents($config['pathLeaseFile']);

/**
 * Decompose values
 */
$arrayDevices = explode("\n", $leaseFileContent);
foreach ($arrayDevices as $num => $process) {
    if($process != "")
        $arrayDevices[$num] = explode(" ", $process);
    else {
        //Remove empty lines
        unset($arrayDevices[$num]);
    }
}

/**
 * Begin return
 */
?><!DOCTYPE html>
<html>
    <head>
        <title>Devices list - Dnsmasq</title>
        
        <!-- Head elements inclusion -->
        <?php include("views/headElements.php"); ?>
    </head>
    <body>
        <h1 style="text-align: center;"> Devices list </h1>
        
        <!-- Array -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Expire</th>
                        <th>MAC Address</th>
                        <th>IP Address</th>
                        <th>Computer name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($arrayDevices as $showDevice){
                            
                            echo "<tr>";
                                //Expiration date
                                if($showDevice[0] != 0)
                                    echo "<td>".date("d/m/Y H:s", $showDevice[0])."</td>";
                                else
                                    echo "<td><i>never</i></td>";
                                
                                //MAC Address
                                echo "<td>".$showDevice[1]."</td>";
                                
                                //IP Address
                                echo "<td>".$showDevice[2]."</td>";
                                
                                //Computer name
                                echo "<td>".$showDevice[3]."</td>";
                                
                                // ?
                                echo "<td>".$showDevice[4]."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
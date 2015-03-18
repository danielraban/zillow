<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript">
        function validateForm() 
        {
            alert("inside fn");
            var x = document.forms["myForm"]["address"].value;
            if (x==null || x=="") {
                alert("First name must be filled out");
                return false;
            }
            //alert("Entered address is : " + x);
            
            var x = document.forms["myForm"]["city"].value;
            if (x==null || x=="") {
                alert("First name must be filled out");
                return false;
            }
            //alert("Entered city is : " + x);
            
            var x = document.forms["myForm"]["state"].value;
            if (x==null || x=="") {
                alert("First name must be filled out");
                return false;
            }
            //alert("Entered state is : " + x);
        }    
        </script>
    </head>
    <body>
        <div id = "input_block"> <!-- style = "left-padding:500px;"-->
            <center><b> REAL ESTATE SEARCH </b></center>
	<form name="myForm" action="index.php" onsubmit="return validateForm()" method="post">
	<center>
	<div style="width:500px; border:1px solid black;">
            <table>  
                <tr><td> Street Address<sup>*</sup>:</td> <td><input type="text" name="address" value="<?php if(isset($_POST['address'])) { echo ($_POST['address']); }?>"></td></tr> 
                <br/><tr><td> City<sup>*</sup>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td> <td> <input type="text" name="city" value="<?php if(isset($_POST['city'])) { echo ($_POST['city']); }?>"> </td></tr>
                <br/><tr><td>State<sup>*</sup> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;:</td><td> <input type="text" name="state" value="<?php if(isset($_POST['state'])) { echo ($_POST['state']); }?>"></td></tr>
                
                </table> 
                    <input type="submit" placeholder="Search">
                <img src="http://www.zillow.com/widgets/GetVersionedResource.htm?path=/static/logos/Zillowlogo_150x40.gif" width="150" height="40" alt="Zillow Real Estate Search" />
                <br/>
                <br/> 
                <sup>* - </sup><i>Mandatory fields</i>
        </div>
	</center>
	</form>
    </div>
        <div>
            
        <?php
        error_reporting(E_ERROR | E_PARSE);
        if(isset($_POST['address']) and isset($_POST['city']) and isset($_POST['state'])){
            echo "<hr/> <br/> <center> The entered data is: "
                    ." <br/><center><b>Address</b>: ".$_POST["address"].", <b>City</b>:"
                    .$_POST["city"]." ,<b>State</b>: ".$_POST["state"]
                    ."</center>";
           
            $data = array(
              'zws-id'=> 'X1-ZWz1b2xqvwjw23_7rj5m',
              'address'=> $_POST["address"],
              'citystatezip'=>$_POST["city"]
              );

            $fields =  http_build_query($data);
            //echo $fields; 
            $fields = $fields."%2C+".$_POST["state"]."&rentzestimate=true";
            //$query = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2xqvwjw23_7rj5m&address=".$given_address."&citystatezip=".$given_city."%2C".$_POST["state"]."&rentzestimate=true";
            //echo "Query sent is : ".$query;
            $query_1 = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2xqvwjw23_7rj5m&address=2636+Menlo+Avenue&citystatezip=los+angeles%2C+CA&rentzestimate=true";
            $query = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?".$fields;
            //echo "<br/>".$query;
            //echo "<br/>".$query_1;
            $xml=simplexml_load_file($query);
            //print_r($xml);
            
            echo "Message : ".$xml->message->text." <br/>";
            echo "Message code received : ".$xml->message->code." <br/>";
            $response_code = $xml->message->code;
            
            if($response_code == 0){
                //echo "Address: ".$xml->request->address.", ";
                $address = $xml->request->address;
                //echo $xml->request->citystatezip." <br/>";
                $citystatezip = $xml->request->citystatezip;
           
                //echo $xml->response->results->result->zpid." <br/>";
                $zpid = $xml->response->results->result->zpid;
                
                //echo $xml->response->results->result->address->street." <br/>";
                $street = $xml->response->results->result->address->street;
                
                //echo $xml->response->results->result->address->zipcode." <br/>";
                $zipcode = $xml->response->results->result->address->zipcode;
                //echo $xml->response->results->result->address->city." <br/>";
                $city = $xml->response->results->result->address->city;
                //echo $xml->response->results->result->address->state." <br/>";
                $state = $xml->response->results->result->address->state;

                //echo "Property details <br/>";
            
                //echo $xml->response->results->result->useCode." <br/>";
                $useCode = $xml->response->results->result->useCode;
                //echo $xml->response->results->result->yearBuilt." <br/>";
                $yearBuilt = $xml->response->results->result->yearBuilt;
                //echo $xml->response->results->result->lotSizeSqFt." <br/>";
                $lotSizeSqft = $xml->response->results->result->lotSizeSqFt;
                //echo $xml->response->results->result->finishedSqFt." <br/>";
                $finishedSqFt = $xml->response->results->result->finishedSqFt;
            
                //echo $xml->response->results->result->bathrooms." <br/>";
                $bathrooms = $xml->response->results->result->bathrooms;
                //echo $xml->response->results->result->bedrooms." <br/>";
                $bedrooms = $xml->response->results->result->bedrooms;
            
                //echo $xml->response->results->result->taxAssessmentYear." <br/>";
                $taxAssessmentYear = $xml->response->results->result->taxAssessmentYear;
                
                //echo $xml->response->results->result->taxAssessment." <br/>";
                $taxAssessment = $xml->response->results->result->taxAssessment;
            
                //echo $xml->response->results->result->lastSoldDate." <br/>";
                $lastSoldDate = $xml->response->results->result->lastSoldDate;
                //echo $xml->response->results->result->lastSoldPrice." <br/>";
                $lastSoldPrice = $xml->response->results->result->lastSoldPrice;
                
                
                //echo $xml->response->results->result->zestimate->{'last-updated'};
                $lastUpdatedDate = $xml->response->results->result->zestimate->{'last-updated'};

                // Estimate of prices
                $amount = $xml->response->results->result->zestimate->amount;
                //echo $amount."<br/>";
                
                $property_lowvalue = $xml->response->results->result->zestimate->valuationRange->low;
                $property_highvalue = $xml->response->results->result->zestimate->valuationRange->high."<br/>";
                
                //echo $property_lowvalue. " - ".$property_highvalue." <br/>";
                $oneMonthChange = $xml->response->results->result->zestimate->valueChange;
                //echo $oneMonthChange."<br/>";
                      
                //Estimate of rents
                $rent_amount = $xml->response->results->result->rentzestimate->amount;
                $lastRentUpdatedDate = $xml->response->results->result->rentzestimate->{'last-updated'};
                $property_lowrentvalue = $xml->response->results->result->rentzestimate->valuationRange->low;
                $property_highrentvalue = $xml->response->results->result->rentzestimate->valuationRange->high;
                
                //echo $property_lowvalue." - ".$property_highvalue." <br/>";
                $oneMonthRentChange = $xml->response->results->result->rentzestimate->valueChange."<br/>";
                 
                
                
                echo "<br/><br/> <b> Search Results </b><br/> ";
                echo "<table border='1' style='background-color:yellow'><tr><td>See more details for <a href='".$query."'>".$address.", ".$citystatezip."</a> on Zillow </td></tr></table>";
                
                
                echo "<table border='1' width = '1024px'> "."<tr>"
                    . "<td>Property type : ".$useCode."</td>"
                    . "<td>Last Sold Price : ".number_format(floatval($lastSoldPrice),2)."</td>"
                    . "</tr>";
                echo "<tr> <td>Year Built:".number_format(intval($yearBuilt))."</td>"
                     ."<td>Last Sold Date : ";
                $formatted_date = date('d-M-Y', strtotime($lastSoldDate));
                echo $formatted_date."</td>";
                
                echo "<tr><td>Lot Size:".number_format(intval($lotSizeSqft))."</td>"
                      ."<td> Zestimate Property Estimate as of ";
                $formatted_date = date('d-M-Y', strtotime($lastUpdatedDate));
                echo $formatted_date." : ";
                echo number_format(floatval($amount),2)."</td>";
                
                echo "<tr><td>Finished Area: ".number_format(intval($finishedSqFt))."</td>"
                      ."<td> 30 day overall change ";
                if(intval($oneMonthChange) > 0){
                    echo "<img src='http://www-scf.usc.edu/~csci571/2014Spring/hw6/up_g.gif'> : ".$oneMonthChange."</td>";
                }else{
                    echo "<img src='http://www-scf.usc.edu/~csci571/2014Spring/hw6/down_r.gif'> : ".number_format(abs(floatval($oneMonthChange)),2)."</td>";
                }
                echo "<tr><td>Bathrooms: ".number_format(floatval($bathrooms),1)."</td>"
                      ."<td>All time property range : ".number_format(intval($property_lowvalue),2)." - ".number_format(intval($property_highvalue),2)."</td>";
                
                echo "<tr><td>Bedrooms: ".$bedrooms."</td>"
                      ."<td>Rent Zestimate Valuation as of ";
                $formatted_date = date('d-M-Y', strtotime($lastRentUpdatedDate));
                echo $formatted_date." : ";
                echo number_format(floatval($rent_amount))."</td>";
                
                
                echo "<tr><td>Tax Assessment Year: ".$taxAssessmentYear."</td>"
                      ."<td>30 Days Rent Change "; 
                
                if(intval($oneMonthRentChange) > 0){
                    echo "<img src='http://www-scf.usc.edu/~csci571/2014Spring/hw6/up_g.gif'> : ".$oneMonthRentChange."</td>";
                }
                else{
                    echo "<img src='http://www-scf.usc.edu/~csci571/2014Spring/hw6/down_r.gif'> : ".$oneMonthRentChange."</td>";
                }
                
                echo "<tr><td>Tax Assessment: ".number_format(floatval($taxAssessment),2)."</td>"
                      ."<td>All Time Rent Range : ".number_format(floatval($property_lowrentvalue),2)." - ".number_format(floatval($property_highrentvalue),2)."</td>";

             }
             else{
                 echo "No output obtained";
             }     
        }
        ?>
        </div>
    </body>
</html>

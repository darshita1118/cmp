<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=session('sid')??''?></title>
    <style>
        tr{
            line-height: 25px !important;
        }
    </style>
</head>

<body>
    <table cellpadding="0" cellspacing="0" width="800px" align="center">
        <tbody>
            <tr>
                <td>
                    <font color="#990000"><b>Program Details</b></font>
                    <hr>
                    <table cellpadding="0" cellspacing="0" width="100%" class="">
                        <tbody>
                            <tr>
                                <td width="70%" valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr style="line-height:35px">
                                                <td width="40%"><strong>Seesion</strong></td>
                                                <td width="60%"><?=session('sessionyear')??''?></td>
                                            </tr>
                                            <tr style="line-height:35px">
                                                <td width="40%">
                                                    <strong>Program</strong>
                                                </td>
                                                <td width="60%"><?= $row->course_name??''; ?></td>
                                            </tr>
                                            <tr style="line-height:35px">
                                                <td width="40%"><strong>SID</strong></td>
                                                <td width="60%"><?=session('sid') ??''?></td>
                                            </tr>
                                            
                                            <tr style="line-height:35px">
                                                <td width="40%"><strong>Enrollment No.</strong></td>
                                                <td width="60%">Pending</td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </td>
                                <td width="30%" align="right"> <img id="ContentPlaceHolder2_Image1"
                                        src="<?= base_url($photo['sd_url']??'')?>"
                                        style="height:120px;width:120px; padding:4px; background:#E9E9E9"
                                        class="img-rounded"></td>
                            </tr>

                        </tbody>
                    </table>

                </td>
            </tr>

            <tr>
                <td>
                    <font color="#990000"><b>Student's Details</b></font>
                    <hr>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Name</strong></td>
                                <td width="30%"><?=session('fullname')??''?></td>
                                <td width="20%"><strong>Gender</strong></td>
                                <td width="30%"><?php  echo 'Male'; ?></td>
                            </tr>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Date of Birth</strong></td>
                                <td width="30%"><?= $row->dob??''; ?> <small>(mm/dd/yyyy)</small></td>
                                <td width="20%"><strong>Religion</strong></td>
                                <td width="30%"><?= $row->r_name??''; ?></td>
                            </tr>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Category</strong></td>
                                <td width="30%"> <?= $row->c_name??''; ?></td>
                                <td width="20%"><strong>Mobile No.</strong></td>
                                <td width="30%"><?= $row->sci_country_code??''; ?>-<?= $row->sci_mobile??''; ?></td>
                            </tr>
                            <tr style="line-height:35px">
                                
                                <td width="20%"><strong>Email Id</strong></td>
                                <td width="30%"><?= $row->sci_email??''; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="padding-top:20px">
                    <font color="#990000"><b>Parent's Details</b></font>
                    <hr>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Father's Name</strong></td>
                                <td width="30%"><?= @$row1->father_name; ?></td>
                                <td width="20%"><strong>Mother's Name</strong></td>
                                <td width="30%"><?= @$row1->mother_name; ?></td>
                            </tr>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Father's Occupation</strong></td>
                                <td width="30%">Rajasthan Police</td>
                                <td width="20%"><strong>Mother's Occupation</strong></td>
                                <td width="30%">house wife</td>
                            </tr>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Father's Annual Income</strong></td>
                                <td width="30%">400000</td>
                                <td width="20%"><strong>Mother's Annual Income</strong></td>
                                <td width="30%"></td>
                            </tr>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Parent's Mobile No.</strong></td>
                                <td width="30%">7240571060</td>
                                <td width="20%"><strong>Parent's Email Id</strong></td>
                                <td width="30%"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="padding-top:20px">
                    <font color="#990000"><b>Postal Address</b></font>
                    <hr>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Address</strong></td>
                                <td width="30%">14, Mitra Vihar -B, Panchyawala</td>
                                <td width="20%"><strong>City</strong></td>
                                <td width="30%">Jaipur</td>
                            </tr>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>District</strong></td>
                                <td width="30%">JAIPUR</td>
                                <td width="20%"><strong>State</strong></td>
                                <td width="30%"> RAJASTHAN</td>
                            </tr>
                            <tr style="line-height:35px">
                                <td width="20%"><strong>Pincode </strong></td>
                                <td width="30%">302034</td>
                                <td width="20%"><strong>Country</strong></td>
                                <td width="30%">India</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="padding-top:20px">
                    <font color="#990000"><b>Academic Details</b></font>
                    <hr>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr height="35" bgcolor="#f5f5f5">
                                <td width="5%" style="border:1px #000000 solid; padding:5px"><strong>S.No.</strong></td>
                                <td width="15%" style="border:1px #000000 solid; padding:5px">
                                    <strong>Examination</strong>
                                </td>
                                <td width="21%" style="border:1px #000000 solid; padding:5px">
                                    <strong>Board/University</strong>
                                </td>
                                <td width="22%" style="border:1px #000000 solid; padding:5px">
                                    <strong>School/College</strong>
                                </td>
                                <td width="22%" style="border:1px #000000 solid; padding:5px"><strong>Year of
                                        Passed/Appearing</strong></td>
                                <td width="10%" style="border:1px #000000 solid; padding:5px"><strong>Max Marks</strong>
                                </td>
                                <td width="10%" style="border:1px #000000 solid; padding:5px"><strong>Obtained
                                        Marks</strong></td>
                                <td width="10%" style="border:1px #000000 solid; padding:5px">
                                    <strong>Percentage</strong>
                                </td>
                                <td width="7%" style="border:1px #000000 solid; padding:5px"><strong>Grade</strong></td>
                            </tr>

                            <tr height="35">
                                <td style="border:1px #000000 solid; padding:5px">1.</td>
                                <td style="border:1px #000000 solid; padding:5px">10th</td>
                                <td style="border:1px #000000 solid; padding:5px">RBSE</td>
                                <td style="border:1px #000000 solid; padding:5px">SSVM</td>
                                <td style="border:1px #000000 solid; padding:5px">2013</td>
                                <td style="border:1px #000000 solid; padding:5px">600</td>
                                <td style="border:1px #000000 solid; padding:5px">408</td>
                                <td style="border:1px #000000 solid; padding:5px">68%</td>
                                <td style="border:1px #000000 solid; padding:5px">68</td>
                            </tr>

                            <tr height="35">
                                <td style="border:1px #000000 solid; padding:5px">2.</td>
                                <td style="border:1px #000000 solid; padding:5px">10+2</td>
                                <td style="border:1px #000000 solid; padding:5px">RBSE</td>
                                <td style="border:1px #000000 solid; padding:5px">SSVM</td>
                                <td style="border:1px #000000 solid; padding:5px">2015</td>
                                <td style="border:1px #000000 solid; padding:5px">500</td>
                                <td style="border:1px #000000 solid; padding:5px">392</td>
                                <td style="border:1px #000000 solid; padding:5px">78.4%</td>
                                <td style="border:1px #000000 solid; padding:5px">78.40</td>
                            </tr>

                            <tr height="35">
                                <td style="border:1px #000000 solid; padding:5px">3.</td>
                                <td style="border:1px #000000 solid; padding:5px">Graduation</td>
                                <td style="border:1px #000000 solid; padding:5px">SGVU</td>
                                <td style="border:1px #000000 solid; padding:5px">SGVU</td>
                                <td style="border:1px #000000 solid; padding:5px">2020</td>
                                <td style="border:1px #000000 solid; padding:5px">10</td>
                                <td style="border:1px #000000 solid; padding:5px">7</td>
                                <td style="border:1px #000000 solid; padding:5px">70%</td>
                                <td style="border:1px #000000 solid; padding:5px">7.9</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>


            

            <tr>
                <td style="padding-top:20px" class="dontprint">
                    <font color="#990000"><b>Documents</b></font>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <td>
                            <small>Photograph of Student</small><br><br>
                            <img src="uploads/1610464667PHoto Sceen.PNG" height="120" width="120" class="img-rounded">
                        </td>
                        <td>
                            <small>10th Marksheet</small><br><br>
                            <img src="uploads/1601457859WhatsApp Image 2020-09-30 at 2.53.10 PM.jpeg" height="120" width="120"
                                class="img-rounded">
                        </td>
                        <td>
                            <small>10+2 Marksheet</small><br><br>
                            <img src="uploads/1601457885WhatsApp Image 2020-09-30 at 2.53.27 PM.jpeg" height="120" width="120"
                                class="img-rounded">
                        </td>
                        <td>
                            <small>Graduation Marksheet</small><br><br>
                            <img src="uploads/1601457635WhatsApp Image 2020-09-30 at 2.49.54 PM.jpeg" height="120" width="120"
                                class="img-rounded">
                        </td>
                        <td>
                            <small>Aadhar Card</small><br><br>
                            <img src="uploads/1601457352WhatsApp Image 2020-01-22 at 2.21.56 PM.jpeg" height="120" width="120"
                                class="img-rounded">
        
                        </td>
                    </table>
                </td>
            </tr>


        </tbody>
    </table>
</body>

</html>
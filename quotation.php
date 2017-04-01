<?php session_start();
$title = "home";
include 'myadmin/class/connect_db.php';
include 'components/components.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php stylesheet($title); ?>
</head>

<body>
    <?php topHeader(); ?>
    <div class="container">
        <?php navHeader(); ?>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
                <h3 class="text-center">เสนอราคา</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>รายการสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>จำนวนเงินรวม</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input class="form-control" type="text" name="" id="">
                    </td>
                    <td>
                        <input class="form-control" type="number" name="" id="">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="" id="">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="" id="">
                    </td>
                </tr>
            </tbody>

            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">มูลค่าสินค้า</td>
                    <td>
                        <input class="form-control" type="text" name="" id="">
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">ส่วนลด %</td>
                    <td>
                        <input class="form-control" type="text" name="" id="">
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">ภาษีมูลค่าเพิ่ม 7%</td>
                    <td>
                        <input class="form-control" type="text" name="" id="">
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">จำนวนเงินรวมทั้งสิ้น</td>
                    <td>
                        <input class="form-control" type="text" name="" id="">
                    </td>
                </tr>
            </tbody>
            
        </table>
        <h3 class="text-center">ข้อมูลผู้ติดต่อ</h3>
        <?php
        if (!empty($_SESSION['id_user'])) {
        ?>
        <table class="table table-bordered">
            <tr>
                <td>กำหนดยืนยันราคา</td>
                <td>
                    <input class="form-control" type="text" name="" id="">
                </td>
                <td>วัน</td>
            </tr>
            <tr>
                <td>ชื่อผู้ติดต่อ</td>
                <td colspan="2">
                    <input class="form-control" type="text" name="" id="" value="<?php echo $_SESSION['fname_user']." ".$_SESSION['lname_user']; ?>">
                </td>
            </tr>
            <tr>
                <td>ที่อยู่</td>
                <td colspan="2">
                    <textarea class="form-control"><?php echo $_SESSION['address_user']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>เบอร์โทร</td>
                <td colspan="2">
                    <input class="form-control" type="text" name="" id="" value="<?php echo $_SESSION['tel_user']; ?>">
                </td>
            </tr>
            <tr>
                <td>หมายเหตุ</td>
                <td colspan="2">
                    <textarea class="form-control"></textarea>
                </td>
            </tr>
        </table>
        <?php
        }else {
        ?>
        <table class="table table-bordered">
            <tr>
                <td>กำหนดยืนยันราคา</td>
                <td>
                    <input class="form-control" type="text" name="" id="">
                </td>
                <td>วัน</td>
            </tr>
            <tr>
                <td>ชื่อผู้ติดต่อ</td>
                <td colspan="2">
                    <input class="form-control" type="text" name="" id="">
                </td>
            </tr>
            <tr>
                <td>ที่อยู่</td>
                <td colspan="2">
                    <textarea class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <td>เบอร์โทร</td>
                <td colspan="2">
                    <input class="form-control" type="text" name="" id="">
                </td>
            </tr>
            <tr>
                <td>หมายเหตุ</td>
                <td colspan="2">
                    <textarea class="form-control"></textarea>
                </td>
            </tr>
        </table>
        <?php
        }
        ?>
        
        <!-- <a href="javascript:void(0);" class="addCF">Add</a>
        <table id="activity_table">
            <tr>
                <th>Activity</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>Option 5</th>
                <th>Total</th>
            </tr>
            <tr id="myadd">
                <td>Activity 1</td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
            </tr>
            <tr class="totalRow">
                <td>Total</td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
            </tr>
        </table> -->


    </div>
    <?php footer(); ?>
    <script>
        $(document).ready(function(){
            $(".addCF").click(function(){
                $("#myadd").after('<tr><td>Activity 1</td><td><input type="text"></td><td><input type="text"></td><td><input type="text"></td><td><input type="text"></td><td><input type="text"></td><td><input type="text"></td></tr>');
            });
            $("#activity_table").on('click','.remCF',function(){
                $(this).parent().parent().remove();
            });


            console.clear();


            function updateTotals() {
                $('td:not(:first-child):not(:last-child)',
                    '#activity_table tr:eq(1)').each(function() {
                    var ci = this.cellIndex;
                    var total = 0;
                    $('td','#activity_table tr:gt(0)')
                        .filter(function() {
                            return this.cellIndex === ci;
                        })
                        .each(function() {
                            var inp = $('input', this);
                            if (inp.length) {
                                if (!$(this).closest('tr').is(':last-child')) {
                                    total += $('input', this).val() * 1;
                                } else {
                                    $('input', this).val(total);
                                }
                            }
                        });
                });

                $('#activity_table tr:gt(0)').each(function() {
                    var total = 0;
                    $('td:not(:first-child):not(:last-child)',
                        this).each(function() {
                        total += $('input', this).val() * 1;
                    });
                    $('input', this).last().val(total);
                });
            };

            updateTotals();

            $('#activity_table input').on('keyup change', updateTotals);
        });
        

    </script>
    <!-- http://jsfiddle.net/ze83fuzx/1/ -->
</body>

</html>

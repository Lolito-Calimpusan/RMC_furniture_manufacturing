<?php
    require '../connections/config.php';
    if (isset($_POST['submit'])) {
        $teacher_id = $_POST['teacher_id'];
        $feedback_id = $_POST['feedback_id'];

        $stmt = $conn->prepare("SELECT * FROM teachers_subjects WHERE id = ?");
        $stmt->bind_param("i", $feedback_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $subject = $row['subject'];
        }
    }

    require_once './vendor/autoload.php';
    
    use Dompdf\Dompdf;
    
    // Initialization ng Dompdf
    $dompdf = new Dompdf();
    
    // Simulan ang output buffering
    ob_start();
    
    // Simulang ng HTML content na may table
    ?>
<h2 style="text-align: center;">NorthEastern Mindanao Colleges</h2>

<h4 style="text-align: center;">Teacher's feedback System</h4>

  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="box-shadow: 0px 0px 6px 2px rgba(0, 0, 0, 0.2); background-color: whitesmoke; text-align: center; border: 1px solid black;">
    <thead>
        <tr style="border: 1px solid black;">
            <th>No.</th>
            <th>Student ID</th>
            <th>Subject</th>
            <th>Total Ratings</th>
            <th>Comments & Suggestions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $teacher_id = $_POST['teacher_id'];
        $subject = $row['subject'];
        $grand_total = 0;

        $statement = $conn->prepare("SELECT * FROM student_ratings WHERE teacher_id = ? AND subject = ? GROUP BY student_id");
        $statement->bind_param("is", $teacher_id, $subject);
        $statement->execute();
        $results = $statement->get_result();

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $student_id = $row['student_id'];

                $stmts = $conn->prepare("SELECT SUM(rating) as total_ratings, comments FROM student_ratings WHERE subject = ? AND student_id = ?");
                $stmts->bind_param("ss", $subject, $student_id);
                $stmts->execute();
                $result_student_id = $stmts->get_result();

                if ($result_student_id->num_rows > 0) {
                    $rows = $result_student_id->fetch_assoc();
                    $total_ratings = $rows['total_ratings'];
                    $comments = $rows['comments'];
                    $grand_total += $total_ratings;
        ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $student_id; ?></td>
                        <td><?= $subject; ?></td>
                        <td><?= $total_ratings; ?></td>
                        <td><?= $comments; ?></td>
                    </tr>
        <?php
                }
            }
        } else {
            echo '<tr><td colspan="5" style="text-align: center;">No Feedbacks Yet</td></tr>';
        }

        // Check kung may laman ang table bago ipakita ang grand total
        if ($grand_total > 0) {
        ?>
            <tr style="border: 1px solid black;">
                <td colspan="3" style="text-align: right; font-weight: bold;">Grand Total:</td>
                <td colspan="2"><p style="text-align: left;"><?= $grand_total; ?></p></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
    <?php
    // Kunin ang output ng HTML
    $html = ob_get_clean();
    
    // I-load ang HTML content sa Dompdf
    $dompdf->loadHtml($html);
    
    // Set Paper Size at Orientation ng PDF
    $dompdf->setPaper('A4', 'Portrait');
    
    // Rendering ng HTML content sa PDF
    $dompdf->render();
    
    // Save ng generated PDF sa isang file na 'output.pdf'
    $pdfOutput = $dompdf->output();
    file_put_contents('output.pdf', $pdfOutput);
    
    // Force download ng generated PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment;filename="output.pdf"');
    echo $pdfOutput;
    exit;

    
    ?>
    
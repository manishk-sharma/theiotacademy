<table width="100%" cellpadding="0" cellspacing="0" 
       style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; background:#f5f5f5; padding:20px;">
    <tr>
        <td align="left">
            <table width="700" cellpadding="0" cellspacing="0" 
                   style="background:#ffffff; border:1px solid #ddd; border-collapse: collapse;">
                
                <!-- HEADER -->
                <tr>
                    <td colspan="2" 
                        style="background:#2f2f2f; color:#ffffff; text-align:center; 
                               font-size:18px; font-weight:bold; padding:12px;">
                        New Application Received
                    </td>
                </tr>

                <!-- ROW -->
                <?php
                function row($label, $value){
                    return '
                    <tr>
                        <td style="width:35%; padding:10px; border:1px solid #ddd; font-weight:bold; background:#f7f7f7;">'
                        .$label.
                        '</td>
                        <td style="width:65%; padding:10px; border:1px solid #ddd;">'
                        .$value.
                        '</td>
                    </tr>';
                }

                echo row('Name', $applicant_name);
                echo row('Email', $applicant_email);
                echo row('Mobile', $applicant_mobile);
                echo row('Degree', $applicant_degree);
                echo row('Experience', $applicant_work_exp);
                echo row('Industry', $applicant_industry);
                echo row('Course', $applicant_came_from);
                ?>

                <!-- SOP -->
                <?php if(!empty($applicant_sop)){ ?>
                <tr>
                    <td style="padding:10px; border:1px solid #ddd; font-weight:bold; background:#f7f7f7;">
                        Statement of Purpose
                    </td>
                    <td style="padding:10px; border:1px solid #ddd; line-height:1.6;">
                        <?= nl2br(htmlspecialchars($applicant_sop)) ?>
                    </td>
                </tr>
                <?php } ?>

                <!-- RESUME -->
                <?php if(!empty($resume_link)){ ?>
                <tr>
                    <td style="padding:10px; border:1px solid #ddd; font-weight:bold; background:#f7f7f7;">
                        Resume
                    </td>
                    <td style="padding:10px; border:1px solid #ddd;">
                        <a href="<?= $resume_link ?>" 
                           style="color:#0066cc; text-decoration:none; font-weight:bold;">
                            Download Resume
                        </a>
                    </td>
                </tr>
                <?php } ?>

            </table>
        </td>
    </tr>
</table>

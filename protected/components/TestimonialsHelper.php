<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestimonialsHelper
 *
 * @author mdcconcepts
 */
class TestimonialsHelper {

    //put your code here

    public static function getSelectedFeedbackValueStars() {

        if (!isset($_GET['feedback'])) {
            echo "All";
        } else {

            switch ($_GET['feedback']) {
                case "all":
                    echo "All";

                    break;
                case 0:
                    ?>
                    <?php

                    for ($index = 0; $index < 5; $index++) {
                        ?>
                        <i class="fa fa-star-o"></i> 
                        <?php

                    }
                    break;
                case 1 :
                    ?> <i class="fa fa-star"></i> <?php

                    for ($index = 0; $index < 4; $index++) {
                        ?>
                        <i class="fa fa-star-o"></i> 
                        <?php

                    }

                    break;
                case 2:
                    ?> <i class="fa fa-star"></i><i class="fa fa-star"></i><?php

                    for ($index = 0; $index < 3; $index++) {
                        ?>
                        <i class="fa fa-star-o"></i> 
                        <?php

                    }

                    break;
                case 3:
                    for ($index = 0; $index < 3; $index++) {
                        ?>
                        <i class="fa fa-star"></i> 
                        <?php

                    }
                    ?> <i class="fa fa-star-o"></i> 
                    <i class="fa fa-star-o"></i>
                    <?php

                    break;
                case 4:
                    for ($index = 0; $index < 4; $index++) {
                        ?>
                        <i class="fa fa-star"></i> 
                        <?php

                    }
                    ?> <i class="fa fa-star-o"></i> 
                    <?php

                    break;
                case 5:
                    for ($index = 0; $index < 5; $index++) {
                        ?>
                        <i class="fa fa-star"></i> 
                        <?php

                    }

                    break;

                default:
                    break;
            }
        }
    }

}

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modals
 *
 * @author tino
 */
class NzBsCarousel
{

    private static $carousel_count = 0;
    private static $first_slide = 1;

    public function add_shortcodes()
    {
        add_shortcode('nz_bs_carousel', array($this, 'carousel_shortcode'));
        add_shortcode('nz_bs_carousel_item', array($this, 'carousel_item_shortcode'));
    }

    private function error($msg)
    {
        if (current_user_can('manage_options')) {

            return $msg;
        }
    }

    private function getCarouselId()
    {
        return 'nz-bs-carousel-' . self::$carousel_count;
    }

    public function carousel_shortcode($options, $content)
    {

        if (empty($content)) {
            return $this->error('carousel content is empty');
        }
        $content = do_shortcode(strip_tags($content, '<img><div><a>'));
        self::$first_slide = true;

        if (isset($options['indicators'])) {
            $options['indicators'] = filter_var($options['indicators'], FILTER_VALIDATE_BOOLEAN);
        }

        if (isset($options['controls'])) {
            $options['controls'] = filter_var($options['controls'], FILTER_VALIDATE_BOOLEAN);
        }
        self::$carousel_count ++;
        $options = shortcode_atts(array(
            'indicators' => false,
            'controls' => false,
            ), $options);
        ?>

        <div id="<?php echo $this->getCarouselId() ?>" class="carousel slide" data-ride="carousel">
            <?php
            if ($options['indicators']) {
                ?>
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#<?php echo $this->getCarouselId() ?>" data-slide-to="0" class="active"></li>
                    <li data-target="#<?php echo $this->getCarouselId() ?>" data-slide-to="1"></li>
                </ol>
                <?php
            }
            ?>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php echo $content ?>
            </div>
            <?php
            if ($options['controls']) {
                ?>
                <!-- Controls -->
                <a class="left carousel-control" href="#<?php echo $this->getCarouselId() ?>" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#<?php echo $this->getCarouselId() ?>" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <?php
            }
            ?>
        </div>
        <?php
    }

    public function carousel_item_shortcode($options, $content)
    {
        $active = (self::$first_slide) ? ' active' : '';
        self::$first_slide = false;
        $format = '<div class="item%s">%s</div>';


        return sprintf($format, $active, do_shortcode($content));
    }
}

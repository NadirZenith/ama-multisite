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
class NzBsModals
{

    private $img_popovers = false;
    private $modals;

    public function add_shortcodes()
    {
        add_shortcode('nz_bs_modals_trigger', array($this, 'add_modal_trigger'));
        add_shortcode('nz_bs_popover_img_trigger', array($this, 'add_popover_trigger'));
        add_shortcode('nz_bs_modals_content', array($this, 'add_modal_content'));
        add_filter('the_content', array($this, 'fix_shortcodes'));
    }

    public function fix_shortcodes($content)
    {
        $array = array(
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;
    }

    private function error($msg)
    {
        if (current_user_can('manage_options')) {

            return $msg;
        }
    }

    public function add_modal_trigger($options, $content)
    {
        $opt = array_merge(array(
            'id' => false,
            'class' => '',
            'iconclass' => '',
            'title' => false,
            'title_tag' => false,
            ), $options);

        extract($opt);

        if (!$id) {
            return $this->error('id="blah" param missing from modal trigger');
        }
        if (!$iconclass) {
            return $this->error('iconclass="blah" param missing from modal trigger');
        }
        if (!$title) {
            return $this->error('title="blah" param missing from modal trigger');
        }

        if ($title_tag) {
            $title = sprintf('<%s>%s</%s>', $title_tag, $title, $title_tag);
        }

        $trigger_format = '<a class="%s" href="#%s" data-toggle="modal">%s</a>';
        $inner_format = '<i class="%s"></i>%s';

        $inner = sprintf($inner_format, $iconclass, $title);

        return sprintf($trigger_format, $class, $id, $inner);
        ?>
        <!--
                <a class="s">
                    <i class="s"></i>
                    !<s>title</s>
                </a>
        -->
        <?php
    }

    public function add_popover_trigger($options, $content)
    {
        $opt = array_merge(array(
            'id' => false,
            'class' => '',
            ), $options);

        extract($opt);

        $trigger_format = '<a class="%s" href="#%s" data-toggle="popover">%s</a>';
        $this->img_popovers = true;
        return sprintf($trigger_format, $class, $id, $content);
    }

    public function add_modal_content($options, $content)
    {

        $opt = array_merge(array(
            'id' => false,
            ), $options);

        if (!$opt['id']) {
            return $this->error('id="blah" param missing');
        }
        $this->modals[$opt['id']] = $content;
    }

    public function print_modals()
    {
        if (!empty($this->modals)) {
            ?>
            <div id="hidden-modals">
                <?php
                foreach ($this->modals as $k => $modal) {
                    /* d($modal); */
                    ?>
                    <div class="full-screen-modal modal fade" id="<?php echo $k ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-content">
                            <div class="close-modal" data-dismiss="modal">
                                <div class="lr">
                                    <div class="rl">
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-lg-offset-2">
                                        <div class="modal-body"><?php echo $modal; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if ($this->img_popovers) {
                    ?>
                    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="img-responsive" id="modalimagepreview" alt="modal-img" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
}

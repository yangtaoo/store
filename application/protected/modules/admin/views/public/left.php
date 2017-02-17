<div class="col-md-2 bootstrap-admin-col-left">
    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
        <?php foreach(MenuModel::getInstance()->childMenu as $key => $val){ ?>
            <li id="menu_<?php echo $key ?>" <?php echo strtolower($val['url']) == strtolower('/admin/' . $this->getId() . '/' . $this->action->getId()) || (isset($hoverUrl) && strtolower($val['url']) == strtolower($hoverUrl)) ? ' class="active"' : '' ?>>
                <a href="<?php echo $val['url'] ?>">
                    <?php if ($val['countName']) { ?>
                        <?php
                        $cnt = 0;
                        if ($val['countName'] == 'message') {
                            $cnt = MessageModel::getInstance()->getNotReadMessageNum();
                        }
                        ?>
                        <span class="badge pull-right" ><?php echo $cnt; ?></span>
                    <?php } else { ?>

                    <?php } ?>
                    <?php echo $val['name']; ?>
                </a>
                <?php if(isset($val['child'])){ ?>
                <i></i>
                <div class="weixin_menu" id="weixin_menu">
                    <?php foreach($val['child'] as $v){ ?>
                    <a<?php echo strtolower($v['url']) == strtolower('/admin/' . $this->getId() . '/' . $this->action->getId()) || (isset($hoverUrl) && strtolower($v['url']) == strtolower($hoverUrl)) ? ' class="hover"' : '' ?> href="<?php echo $v['url'] ?>"><?php echo $v['name'] ?></a>
                    <?php } ?>
                </div>
                <?php } ?>
            </li>
        <?php } ?>
        
    </ul>
</div>
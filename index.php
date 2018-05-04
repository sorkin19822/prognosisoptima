<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if ($task === 'edit' || $layout === 'form')
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add template js
JHtml::_('script', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'floatingcarousel.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add Stylesheets
JHtml::_('stylesheet', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'system.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

// Use of Google Font
if ($this->params->get('googleFont'))
{
	JHtml::_('stylesheet', 'https://fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$this->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$this->addStyleDeclaration('
	body.site {
		border-top: 3px solid ' . $this->params->get('templateColor') . ';
		background-color: ' . $this->params->get('templateBackgroundColor') . ';
	}
	a {
		color: ' . $this->params->get('templateColor') . ';
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: ' . $this->params->get('templateColor') . ';
	}');
}

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Check for a custom js file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount)
{
	$span = 'span6';
}
elseif ($position7ModuleCount && !$position8ModuleCount)
{
	$span = 'span9';
}
elseif (!$position7ModuleCount && $position8ModuleCount)
{
	$span = 'span9';
}
else
{
	$span = 'span12';
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117661623-1"></script>

<!-- Google Analytics -->
<script>

</script>
<!-- End Google Analytics -->

    <script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-117661623-1', 'auto');
ga('send', 'pageview');
    </script>

	
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '')
	. ($this->direction === 'rtl' ? ' rtl' : '');
?>">
<div class="wrap uk-margin-auto">
    <header>
        <div class="uk-clearfix">
            <div uk-grid="" class="uk-float-right uk-width-1-3 uk-flex uk-flex-middle phones uk-grid uk-grid-stack">
                <div class="uk-margin-auto uk-first-column">
                    <div class="flags uk-flex uk-flex-middle uk-flex-right">
                        <a class="uk-navbar-toggle mySearch" href="#modal-full" uk-toggle></a>
                        <img src="<?php echo 'templates/'.$this->template; ?>/images/ua.jpg" class="flag">
                    </div>
                </div>
            </div>
        </div>

        <div uk-grid="" class="uk-margin-remove@m uk-grid">
            <div class="uk-width-1-2@s uk-width-1-3@m uk-flex-center brandWrapper">
                <a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
                    <?php echo $logo; ?>
                    <?php if ($this->params->get('sitedescription')) : ?>
                        <?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
                    <?php endif; ?>
                </a>
            </div>
            <div class="uk-width-1-2@s uk-width-1-3@m uk-flex uk-flex-between spravka">
                <a href="#" class="ask-link uk-flex uk-flex-middle contactus-94 getTitle" title="Узнать стоимость лечения"><img src="<?php echo 'templates/'.$this->template; ?>/images/svg/wallet.svg"><span class="icon-ask">цена<br> лечения</span></a>
                <a href="#" class="ask-link uk-flex uk-flex-middle contactus-94 getTitle" title="Вопрос онкологу"><img src="<?php echo 'templates/'.$this->template; ?>/images/svg/putanna.svg"><span class="icon-ask">вопрос<br> онкологу</span></a>
                <a class="ask-link uk-flex uk-flex-middle callback-text contactus-94 getTitle" title="Заказать обратный звонок">
                    <img src="<?php echo 'templates/'.$this->template; ?>/images/svg/truba.svg">
                    <span class="icon-ask">заказать<br>обратный<br class="hiddenBr"> звонок</span>
                </a>
            </div>
            <div class="uk-width-1-3 uk-flex uk-flex-center phones uk-visible@m">
                <div><a href="tel:380954087707" class="top-phone phone1">+38 (095) 408 77 07</a><br>
                    <a href="tel:380684087707" class="top-phone phone2">+38 (068) 408 77 07</a></div>
            </div>
        </div>


        <div class="top-menu-wrapper uk-flex uk-flex-middle">
            <jdoc:include type="modules" name="top-menu" style="xhtml"/> <span style="padding-left: 10px; margin: auto auto auto auto;" class="uk-text-small">Наш веб-сайт находится в разработке</span>
        </div>
        <div><jdoc:include type="modules" name="prosto" style="xhtml"/></div>

    </header>
    <main id="content" role="main" class="<?php echo $span; ?>">
        <!-- Begin Content -->
        <jdoc:include type="modules" name="position-2" style="xhtml" />
        <jdoc:include type="modules" name="topslider" style="xhtml" />
        <jdoc:include type="message" />
        <jdoc:include type="component" />
        <jdoc:include type="modules" name="position-3" style="xhtml" />
        <div class="clearfix"></div>
        <!-- End Content -->
        <div><jdoc:include type="modules" name="bottom" style="none" /></div>
    </main>


    <!-- Footer -->
    <footer class="footer" role="contentinfo">
        <jdoc:include type="modules" name="footer-1" style="none" />


        <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
            <div class="uk-width-1-1" style="border: 1px solid black"></div>
            <div class="uk-width-1-1" style="border: 1px solid red; margin-top: 1px;"></div>
            <div class="uk-width-1-1" style="border: 1px solid yellow; margin-top: 1px;"></div>
            <jdoc:include type="modules" name="footer" style="none" />
            <!--<p class="pull-right">
                <a href="#top" id="back-top">
                    <?php /*echo JText::_('TPL_PROGNOSISOPTIMA_BACKTOTOP'); */?>
                </a>
            </p>-->
            <!--<p>
                &copy; <?php /*echo date('Y'); */?> <?php /*echo $sitename; */?>
            </p>-->
        </div>
    </footer>
    <div><jdoc:include type="modules" name="debug" style="none" /></div>
    <div><jdoc:include type="modules" name="search" style="none" /></div>
</div>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = 'EMZ1FMiFuX';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbka6SlCRryiArnKeHt7FE_kGf1kPXGrE&callback=initMap&language=ua&region=UA&callback=initMap">
</script>
</body>
</html>

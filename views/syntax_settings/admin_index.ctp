<style type="text/css">
	div.language div.checkbox {
		width:25%;
		float:left;
	}
</style>

<div class="settings form">
    <h2><?php echo $title_for_layout; ?></h2>
	 <h3>Preview</h3>
	 <p><<?php echo Configure::read('Syntax.tagName'); ?> class="brush:php">function foo($var = 'test') {
<br/>  echo 'test' . 5;
<br/>  //end function
<br/>}
<br/>visit: <a href="http://crogo.org">http://crogo.org!</a>
		 </<?php echo Configure::read('Syntax.tagName'); ?>>
    <br />
	 <p>Below are a list of default settings for each SyntaxHighlighted area. For more information, visit <a href="http://alexgorbatchev.com/SyntaxHighlighter/manual/configuration/" target="_blank">SyntaxHighlighter Configuration</a>.</p>
	 <?php
       	echo $form->create('Setting', array(
           'url' => array(
			  'plugin' => 'syntax',
               'controller' => 'syntax_settings',
               'action' => 'index'
           ),
       ));
    ?>
	 <fieldset>
		 <h3>Include languages</h3>
		 <?php
		 $i = 0;
		 foreach ($languages as $setting) {
            $key = $setting['Setting']['key'];
            $keyE = explode('.', $key);
            $keyTitle = Inflector::humanize($keyE['1']);

				$label = $keyTitle;
            if ($setting['Setting']['title'] != null) {
                $label = $setting['Setting']['title'];
            }

				 echo '<div class="language">';
             echo $form->input("Setting.$i.id", array('value' => $setting['Setting']['id']));
             echo $form->input("Setting.$i.key", array('type' => 'hidden', 'value' => $key));

				if ($setting['Setting']['value'] == 1) {
					echo $form->input("Setting.$i.value", array(
						 'label' => $label,
						 'type' => 'checkbox',
						 'checked' => 'checked',
						 'rel' => $setting['Setting']['description'],
						 ));
					} else {
						echo $form->input("Setting.$i.value", array(
							 'label' => $label,
							 'type' => 'checkbox',
							 'rel' => $setting['Setting']['description'],
							 ));
					 }
				echo "</div>";
            $i++;
		 }
			?>
		 <br clear="all" />
	 </fieldset>

    <fieldset>
    <?php
        foreach ($settings AS $setting) {
            $key = $setting['Setting']['key'];
            $keyE = explode('.', $key);
            $keyTitle = Inflector::humanize($keyE['1']);

            $label = $keyTitle;
            if ($setting['Setting']['title'] != null) {
                $label = $setting['Setting']['title'];
            }

            $inputType = 'text';
            if ($setting['Setting']['input_type'] != null) {
                $inputType = $setting['Setting']['input_type'];
            }

            echo '<div class="setting">';
                echo $form->input("Setting.$i.id", array('value' => $setting['Setting']['id']));
                echo $form->input("Setting.$i.key", array('type' => 'hidden', 'value' => $key));
                switch ($inputType) {
						 case 'checkbox':
                    if ($setting['Setting']['value'] == 1) {
                        echo $form->input("Setting.$i.value", array(
                            'label' => $label,
                            'type' => $inputType,
                            'checked' => 'checked',
                            'rel' => $setting['Setting']['description'],
                        ));
                    } else {
                        echo $form->input("Setting.$i.value", array(
                            'label' => $label,
                            'type' => $inputType,
                            'rel' => $setting['Setting']['description'],
                        ));
						  }
						break;
						case 'select':
						
						 $options = ${Inflector::pluralize(Inflector::variable($label))};
						 echo $form->input("Setting.$i.value", array(
                        'label' => $label,
                        'type' => $inputType,
                        'value' => $setting['Setting']['value'],
                        'rel' => $setting['Setting']['description'],
								'options' => $options
                    ));
						 break;
						default:
                    echo $form->input("Setting.$i.value", array(
                        'label' => $label,
                        'type' => $inputType,
                        'value' => $setting['Setting']['value'],
                        'rel' => $setting['Setting']['description']
                    ));
                 break;

					 }

            echo "</div>";
            $i++;
        }
    ?>
    </fieldset>
    <?php echo $form->end("Submit"); ?>
</div>
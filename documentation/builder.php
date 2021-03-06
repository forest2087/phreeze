<?php include_once '_header.php' ?>

<h3 id="top">Phreeze Builder</h3>

<img src="images/builder-01.png" class="pull-right" />

<p>Phreeze Builder is a utility that analyzes a database and auto-generates 
a basic application that is ready to use and/or customize.
Phreeze builder uses templates to generate different types of applications.</p>

<h4 id="schema">Database Schema Recommendations</h4>

<p>Phreeze can work with just about any existing schema.  However if you are starting from scratch then 
you can optimize your schema for Phreeze by following a few simple naming conventions:</p>

<ul>
<li><span class="label label-important">Required</span> All tables must have a primary key that is comprised of one column.  Tables without
a primary key or a composite primary key are not supported.</li>
<li><span class="label label-warning">Recommended</span> All table relationships should be explicitly defined with a foreign key constraint.  Phreeze builder
analyzes foreign keys in order to determine how tables are related.</li>
<li><span class="label label-warning">Recommended</span> All tables and columns are lower-case with underscore characters as a delimiter.  
For example `purchase_order` not `Purchase Order`, `purchaseOrder`, etc.  This will affect the builder's 
ability to create cleanly named classes for your model.</li>
<li><span class="label label-warning">Recommended</span> Use singular names for your tables.  For example use a table name `customer`, not `customers`.  
Using singular names will help the builder to guess appropriate singular/plural class names for your model.</li>
<li><span class="label label-success">Optional</span> Give each table a unique column prefix.  For example the customer table columns might 
be c_id, c_name, c_age, etc.  This makes writing reporter classes easier, but is not required.</li>
</ul>

<h4 id="builder">Running Phreeze Builder</h4>

<img src="images/builder-02.png" class="pull-right" />

<p>Phreeze builder is included withe the Phreeze library and is located in the /builder/ sub-directory.  Assuming you have
saved the /phreeze/ folder in your localhost web root, you can open Phreeze builder at the following URL:</p>

<p><code>http://localhost/phreeze/builder/</code></p>

<p style="clear: left;">The first screen of the builder application will ask for your MySQL connection settings.  Providing these settings
will do two things: first the builder app will connect and analyze your schema and second, it will re-use this 
information to create a _machine_config.php file in the generated application.  This way your generated application
will be ready to run without editing any config files</p>

<p>Once you have entered your database information, you will see the results of the schema analysis.  You should
review all of the singular and plural names that were calculated by the builder app and make any adjustments.  The
builder attempts to guess appropriate names for your model classes, however it doesn't alwasy guess 
nuances of spoken language and may need your corrections.</p>

<p>Below the table names is a drop-down to select the application that you wish to geneate.  You can choose from 
various template engines based on your personal preferences, generate a unit test harness or generate only the 
model files for your schema.</p>

<p>There are additional options below this where you can specify the name of your application, the root URL
where this application will exist and the relative path to the /phreeze/libs/ directory.</p>

<p>Once you are satisfied with your settings, click the "Generate Application" button and you will be prompted
to download a .zip file.  This .zip file contains all of the files needed for your application.</p>

<h4 id="app">Running Your Generated Application</h4>

<p>Depending on the path and root URL you specified, you should expand your application .zip file in the appropriate
location on your server.  If you selected Smarty as your template engine then you may need to configure the permissions
of the /templates_c/ directory to allow write permissions.  If you selected the Laravel/Blade template engine then
you may need to alter the permissions on /storage/views/ to allow writing.</p>

<p>Once the appliation is installed on your server and optionally the permissions have been updated you are ready 
to run your application.  Open your browser to the appropriate location such as:</p>

<p><code>http://localhost/yourappname/</code></p>

<p>If all has gone according to plan then you should see your application welcome screen!</p>

<h4 id="templates">Customizing Phreeze Builder Templates</h4>

<p>The applications that are generates by Phreeze Builder are based off of Smarty templates located in the phreeze/builder/code/ directory.
Each application consists of two parts: a 'config' and one or more templates.
The builder app looks for *.config files in the /code/ directory.  If you open an existing config file you will see a [parameters] section
for application name and description following by a [files] section for template files.  The files section lists the source template
that will be used and their destination in the generated application.  For example:</p>

<pre>
[files]
phreeze.backbone/libs/Controller/Controller.php.tpl	libs/Controller/{$singular}Controller.php	0
phreeze.backbone/index.php.tpl	index.php	1
phreeze.backbone/bootstrap/css/bootstrap-combobox.css	bootstrap/css/bootstrap-combobox.css	2
</pre>

<p>The first column in the list is the name of the source template file.  The second column is the 
"destination" for the resulting file(s) in the generated application.  The file name of the destination may contain placeholders such as 
{$singular} or {$plural} which means this will be replaced with the table singular or plural name.
The name can be forced as all lower-case using a Smarty modifier such as {$singular|lower}.</p>

<p>The third column is either 0, 1 or 2 and refers to the method to use when parsing the template:</p>

<ol start="0">
<li>A template will be parsed and generated for each table in the database</li>
<li>A template will be parsed and generated only once for the application (for example index.php)</li>
<li>A template will be copied as-is without parsing (images, script libraries, etc)</li>
</ol>

<p>The best way to get started with your own applications is by looking into the source of some of the existing
appliations.  Within each tempalate you can loop through tables and columns as well as access meta information
about the database schema.</p>

<?php include_once '_footer.php' ?>
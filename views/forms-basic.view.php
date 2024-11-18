<main class="container">
  <article>
    <section>
      <h1><?=$mainTitle ?></h1>
      <p>
        Forms! One of the great mysteries for someone just entering the world of
        front-end development is forms. They are fairly easy to build with HTML
        and nicely styled with CSS, however, how do you deal with the data that
        the form holds? What happens when the user presses the
        <samp>submit</samp> button?
      </p>
      <p>
        My younger self will never forget the answer to those two questions
        <em
          >"that's beyond the scope of this course, we're just dealing with
          front-end technologies"</em
        >. And then we were told, just put this "<samp>something.php</samp>" in
        the forms' <samp>action</samp> attribute and your form will be processed
        on the server. Just like magic!
      </p>
      <p>
        Well, as it goes, one of the most powerfull features of PHP is the way
        it handles forms.
      </p>
    </section>

    <aside>
      <h1>form processing services</h1>
      <p>
        Before I go any further, let me tell you that there are numerous
        companies out on the Internet that will give you the ability to build
        and process your forms and data. My absolute favourite is
        <a href="https://www.ratufa.io/">ratufa.io</a>. They are fantastic! And
        the reason I love them so much is that they give you complete control
        over the styling and build of your form. What I mean by this is that you
        can build your own forms, using your own HTML and CSS. All you need to
        do is include one line of code at the bottom of your HTML document...
      </p>

      <section class="code-block">
        <span>Including Ratufa form processing:</span>
        <pre><code class="language-php"><?=clean($ratufaCode)?></code></pre>
      </section>

      <p>
        ...and they do all the processing for you. Their FREE starter plan
        offers unlimited form submisions and email notifications with a very
        useful 5GB of storage space on their servers. They will even process
        payments on your behalf for a mere $3 / month, all without a single
        piece of back-end code.
      </p>

      <p>
        So, we have an alternative to diving into the intricacies of PHP form
        handling, the benefits of which are speed and security. The development
        time required is drastically reduced and our website or app is protected
        from malicious attack.
      </p>
    </aside>

    <section>
      <h1>build a simple form</h1>
      <p>
        We are looking at how to use PHP to handle our forms in this article,
        so, let's start off by constructing a simple form as an example.
      </p>

      <section class="code-block">
        <span>A simple form:</span>
        <pre><code class="language-php"><?=clean($simpleForm)?></code></pre>
      </section>

      <p>
        We'll add some basic styling to sort out the display of the form
        otherwise the whole form will be displayed on a single line, if it can,
        otherwise, elements of the form will wrap onto the next line when they
        meet the edge of the screen.
      </p>

      <section class="code-block">
        <span>Basic form styles:</span>
        <pre><code class="language-php"><?=clean($formStyles)?></code></pre>
      </section>

      <p>Which gives us this:</p>

      <div class="form-container">
        <form>
          <label for="fname">First Name:</label>
          <input name="name" id="fname" type="text" />

          <label for="lname">Last Name:</label>
          <input name="lname" id="lname" type="text" />

          <label for="age">Your Age:</label>
          <input name="age" id="age" type="number" />

          <button type="submit">Submit</button>
        </form>
      </div>

      <p>Click the submit button to see what happens.</p>
    </section>

    <section>
      <h1>Form Handling</h1>
      <p>
        Now we are ready to start looking at what we need to do to work with our
        form.
      </p>
      <p>What happens if we press the submit button right now?</p>
      <p>
        Nothing! Well, not exactly the page we are on suddenly jumps to the top.
        This is because we haven't specified <samp>action</samp> or
        <samp>method</samp> attributes for the form. When this is the case, the
        form data is sent to the same page that the form is present on. Not very
        useful to us as it happens! It has shown us one thing though, the form
        <em><strong>WAS</strong></em> submitted, even if we leave the form
        empty. That's not so good, we really don't want empty forms being
        submitted to our server &mdash; every click takes up valuable server
        resources.
      </p>

      <h2>Form validation</h2>
      <p>
        In order to prevent our form being submitted empty, or with invalid data
        we have to do some checks, so let's make some modifications to our
        original form including <samp>action</samp>, <samp>method</samp> and some very basic validation attributes.
      </p>

      <section class="code-block">
        <span>Form with very basic HTML validation plus action & method attributes</span>
        <pre><code class="language-php"><?= clean($validatedForm)?></code></pre>
      </section>

      <div class="form-container">
        <form action="includes/formaction2.php" method="post">
          <label for="fname">First Name:</label>
          <input name="fname" id="fname" type="text" required />
      
          <label for="lname">Last Name:</label>
          <input name="lname" id="lname" type="text" required />
      
          <label for="age">Your Age:</label>
          <input name="age" id="age" type="number" required min="1" max="150" />
      
          <button type="submit">Send</button>
         </form> 
      </div>

      <p>Which gives us the very same form we had before, except that, if we now press the submit button without filling in any or all of the fields, a message is displayed to the user &mdash; "Please fill out this field". This is because we added the <samp>required</samp> attribute to each input element. If we try to submit a number in the <samp>age</samp> field that is less than 1, or, greater  than 150, or, if we try to submit non-numeric values, the user recieves an additional message telling them what range of numbers the form will accept, or to enter a number if the data is non-numeric. This is <em>front-end</em> validation. It's the first form of defense against duff data.</p>


      <p>When the data arrives at the server, each field should be checked that it is the correct type of data, e.g. that it is a valid number, text, url, email address and is of the correct length etc. If it is not what is expected, or does not fit the rules of that data type, it should be rejected. Once it is established as valid, it should be prepared for its destination and stripped of any potentially harmful characters.</p>

      <h2>the form's <code>action</code> attribtue</h2>

      <p>The forms' <samp>action</samp> attribute defines where that data gets sent, which can be any valid absolute (https://example.com) or relative (/somefile.php) URL. Generally, we would want to send the data back to the server where the form resides, so we would use a relative URL pointing to a file on our form's server. The file should be capable of handling the form data including <em>server-side</em> validation.</p>

      <h2>the form's <code>method</code> attribute</h2>
      <p>The HTML protocol provides several ways to perform a <samp>request</samp> to the server, with <samp>GET</samp> and <samp>POST</samp> being the most common used. We'll use the <samp>POST</samp> method here as the data is submitted in the body of the <samp>request</samp>. If we use the <samp>GET</samp> <samp>request</samp>, all data is appended to the url in the browser's address bar, including any sensitive data such as passwords!</p>

      <p>So, let's take a look at the <samp>POST</samp> method.</p>

      <h2>the <code>$_POST</code> superglobal</h2>
      <p>When we use the <samp>POST</samp> method to send our form to the server, all the data resides in a <code>superglobal</code> variable called <samp>$_POST</samp>. Let's create a new <code>formaction2.php</code> file so that we can take a look at this <code>superglobal</code> variable.</p>

      <section class="code-block">
        <span>The <code>formaction2.php</code> file</span>
        <pre><code class="language-php"><?= clean($formAction2) ?></code></pre>
      </section>

      <p>So, we've created the <code>$formAction2.php</code> file by adding a <samp>&lt;/br&gt;</samp> tag to the end of our <em>'Thank you'</em> message from our <code>formaction.php file</code>, this forces PHP to print a line break after the message, then we've used the <samp>var_dump</samp> function to print out the entire contents of the <samp>$_POST</samp> <code>superglobal</code>. We wrapped the <samp>var_dump</samp> function in <samp>&lt;pre&gt;</samp> tags to make the printed output a bit more friendly to read.</p>

      <p>Now when we fill out our form and submit it, we get the following output on our <code>formaction2.php</code> page:</p>

      <section class="code-block">
        <span>Form result:</span>
        <pre><code class="language-php"><?= clean($formResult) ?></code></pre>
      </section>

      <p>We can see that the <samp>$_POST</samp> variable contains an associative array storing our form data in <code>name=>value</code> paired indices. While <samp>var_dump</samp> is a useful tool for taking a peek at a variable while we are developing, it's <strong>should not be used in production</strong>.</p>

      <h2>extract data from <code>$_POST</code></h2>

      <p>We can pull out the data from <samp>$_POST</samp> in the same way that you would pull data out of any user defined associative array using the array name and index names.</p>

      <section class="code-block">
        <span>use array indices to access data</span>
        <pre><code class="language-php"><?= clean($formAction3)?></code></pre>
      </section>

      <p>So, we simply used an <samp>echo</samp> command to print out the value of the index named <samp>fname</samp>. Note that the index name must wrapped in quotes. However, we have to take care when doing this, especially because this is raw data that has been entered into our web app'.</p>

      <p><strong>WARNING! Data may contain dragons!</strong></p>

      <p>Every time we need to print or output data to the browser, we need to make it safe and neutralise the possiblility of someone injecting malicious code or HTML markup. Fortunately, that's fairly straight forward with PHP.</p>

      <section class="code-block">
        <span>make data safe to print to the browser</span>
        <pre><code class="language-php"><?= clean($formAction4)?></code></pre>
      </section>

      <p>So, to output content on our <samp>formaction.php</samp> page in a safer way, we'll loop over <samp>$_POST</samp> using a <samp>foreach()</samp> loop, where we can control exactly what gets printed to the page and what does not. We'll use an <samp>if()</samp> condition to make sure we skip printing any field called <samp>password</samp>, just as an example.</p>

      <section class="code-block">
        <span>loop over <samp>$_POST</samp> & make data safe to print to the browser</span>
        <pre><code class="language-php"><?= clean($formAction5)?></code></pre>
      </section>

      <p>So in the above, <samp>$key</samp> holds the fieldname of the current index we are iterating over, and the <samp>if()</samp> condition simply says: <em>"as long as the fieldname is NOT <samp>password</samp></em> then echo the value of the current index." And, we make the data safe using <samp>htmlspecialchars()</samp>. We'll go into the <samp>foreach()</samp> condition in depth in another article, but I thought it would be a good oportunity to slip it in here, as it's real-life use case. Note that we also added a link back to the form page. The output on our <samp>formAction.php</samp> page is now:</p>

      <section class="code-block">
        <span>Form result using <samp>foreach()</samp>:</span>
        <pre><code class="language-php"><?= clean($formResult2) ?></code></pre>
      </section>

      <p>Try submitting our form again to check this out.</p>

      <div class="form-container">
        <form action="includes/formaction.php" method="post">
          <label for="fname">First Name:</label>
          <input name="fname" id="fname" type="text" required />
      
          <label for="lname">Last Name:</label>
          <input name="lname" id="lname" type="text" required />
      
          <label for="age">Your Age:</label>
          <input name="age" id="age" type="number" required min="1" max="150" />
      
          <button type="submit">Send</button>
         </form> 
      </div>

      <p>So, to reiterate, <strong>every single print or echo</strong> statement should use the <samp>htmlspecialchars()</samp> function, however, be aware that <samp>htmlspecialchars()</samp> only makes data safe for embeding strings into HTML markup, it does <strong>NOT</strong> make it safe to use in an SQL query, to use in an HTML attribute, to include it in a JavaScript string etc. etc. For us to be able to embed the data in any other type of code, we must make it comply with the rules of that code type. However, you must be aware that such rules could be too complicated for us to follow them all manually, therefore, whenever possible, we should use dedicated tools (functions) to make the data comply with the rules of the type of code that we are using the data in. For instance, <samp>json_encode()</samp> should be used to properly format data for use in a JSON string and, a JSON string should <em>never</em> be constructed manually.</p>

      <p>What does this mean to us? It means that we should:</p>

      <ul>
        <li>Never inject user input directly into other code</li>
        <li>Use built in PHP functions to sanitze and validate data</li>
        <li>Validate data <em>types</em> and <em>formats</em></li>
        <li>Use prepared statements when interacting with databases</li>
        <li>Use output escaping when displaying data on a website</li>
      </ul>


      <h2>Storing data in a database</h2>
      <p>Lets look at the <samp>$_POST</samp> super global again and the data it is holding from our form:</p>

      <section class="code-block">
        <span>print the contents of <samp>$_POST</samp></span>
        <pre><code class="language-php"><?= clean($dumpPost) ?></code></pre>
      </section>

      <p>output:</p>
      <section class="code-block">
        <span>contents of <samp>$_POST</samp></span>
        <pre><code class="language-php"><?= clean($postData) ?></code></pre>
      </section>

      <p>We can see that our data is stored in an associative array consisting of named <code>key=>value</code> pairs. How can we use that data safely in an SQL query? We must use prepared statements and parameterised values. That means, preparing the SQL statement separately from the data, then, add the data to the query via a parameter in the query instead of using the variable directly, this will ensure that it can not alter the query itself. Using a prepared statement will gaurantee that our query is properly formated. Two methods available for this purpose are PDO and MySQLi prepared statements.</code></p>

      <p>In the next section we'll take a look at how we might actually create one of these using the <samp>mysqli</samp> extension.</p>

      <p>It's worth taking a look at this for <a href="https://phpdelusions.net/pdo" target="_blank">Further reading on PDO</a>.</p>

      <p>One thing to take note of is the fact that PDO used to be far superior to the old <samp>mysql()</samp> method, however, the only essential feature of PDO that is missing from the latest <samp>mysqli()</samp> extension is <em>named placeholders</em>, which can be read about in this <a href="https://phpdelusions.net/pdo/mysqli_comparison" target="_blank">fair comparison of mysqli vs. PDO</a>.</p>

      <h2>the format of prepared statements</h2>

      <p>Creating prepared statements can only be done once you are connected to a database. However, that is beyond the scope of this chapter, so, we'll just examine the actual structure and sequence of the method in this section. Database creation and utilization will be covered another article in detail.</p>

      <p>Skipping the connection to the database, there are three additional stages to creating a prepared statement:</p>

      <ol class="in-article-list">
        <li>prepare the SQL statement using placeholders instead of real variable names.</li>
        <li>bind variables to the placeholders</li>
        <li>execute the prepared statement</li>
      </ol>

      <h3>the <code>mysqli()</code> method</h3>

      <p>The <samp>mysqli()</samp> method can only be used to query a MySQL database. It is the worlds most popular open source database, so, it's a good place to start!</p>
      <p>Further, the <samp>mysqli()</samp> method will <strong>always</strong> run a prepared statement as a prepared statement, whereas, this is not true of the PDO method in some circumstances. I know that sounds crazy, but, it's apparently the case!!!</p>

      <section class="code-block">
        <span>creating a prepared statement with <code>myslqi</code>:</span>
        <pre><code class="language-php"><?= clean($mysqliPrepdStatement) ?></code></pre>
      </section>

      <p>The first line creates a <samp>new</samp> instance of the <samp>mysqli</samp> object, which we then use to build our prepared statement. That's all I'll say about this in this article.</p>

      <p>If you are familiar with SQL statements, the above should not look too alien, if you aren't, then I would suggest reading up and practicing them. There are plenty of resources out there for you.</p>

      <h3>prepare</h3>

      <p>First of all, we create a variable named <samp>$stmt</samp> to hold the prepared statement using the <samp>$mysqli->prepare()</samp> method</p>


      <p>Then we use the SQL command <samp>INSERT INTO</samp> to tell MySQL DB that we want to insert a record into a DB table named <samp>test</samp> and that the data should be inserted into the fields named <samp>id</samp> and <samp>label</samp>. We do this by writing <samp>INSERT INTO test(id, label)</samp>. We then specify the values that we want to insert using <samp>VALUES (?, ?)</samp>. We use question marks <samp>(?, ?)</samp> as placeholders <strong>instead of the <em>actual variable names</em></strong> that our data is stored in.</p>

      <samp>$stmt = $mysqli->prepare("INSERT INTO test(id, label) VALUES (?, ?)")</samp>

      <p>That's our prepared statement ready to use.</p>

      <h3>bind</h3>

      <p>Next, we need to bind the variables holding our data to the parameters (placeholders) of the statement. We are using two variables: <samp>$id</samp> which holds an integer value of <samp>1</samp> and <samp>$label</samp> that holds a <samp>string</samp> with the value of <samp>'PHP'</samp>. To bind the variables, we simply write:</p>

      <samp>$stmt->bind_param("is", $id, $label)</samp>

      <p>This is using the <samp>bind_param()</samp> method of the <samp>$stmt</samp> object. Let's break this down:</p>

      <ul class="in-article-list">
        <li><samp>"is"</samp>: <samp>"i"</samp> means the 1st variable is an <code>integer</code>, <samp>"s"</samp> means the 2nd variable is a <code>string</code></li>
        <li><samp>$id, $label</samp> are the actual names of the variables to bind</li>
      </ul>

      <p><strong>Note:</strong> We <strong>must</strong> write the variable type descriptors <samp>i</samp> & <samp>s</samp> and the variable names in the correct sequence. i.e. <samp>i</samp> represents the first variable <samp>$id</samp> which is bound to the first placeholder <samp>?</samp>. While type descriptor <samp>s</samp> represents the second variable <samp>$label</samp> and the second placeholder <samp>?</samp> used in the prepared statement.</p>
    </section>

    <h3>execute</h3>
    <p>Now we just need to run our statement using the <samp>execute()</samp> method of <samp>$stmt</samp> like so: <samp>$stmt->execute()</samp>. And that's it!</p>

    <p>To reiterate the steps:</p>
    <section class="code-block">
      <span>in short:</span>
      <pre><code class="language-php"><?= clean($mysqliPrepdStatement2) ?></code></pre>
    </section>
    <p>Simple enough! But what this means is that, no matter what, the content of the variables can not become part of the query, as that has been predefined and is set in stone.</p>

    <h3>back to our form data</h3>

    <p>We know that our form data is stored in an associative <samp>array</samp> in the superglobal <samp>$_POST</samp> and that we can retrieve that data using standard <samp>array</samp> methods.</p>

    <p>To recap, the variables from our form are:</p>

      <section class="code-block">
        <span>contents of <samp>$_POST</samp></span>
        <pre><code class="language-php"><?= clean($postData) ?></code></pre>
      </section>
    
    <p>To retrieve the individual values of each index we use bracket notation <samp>$_POST["$arrayKeyName"]</samp>. For simplicity, let's assume that our DB table is called <samp>users</samp> and the table's field names are the same as our form field names above, we can then create some PHP variables to hold our data.</p>

    <section class="code-block">
      <span>create some variables</span>
      <pre><code class="language-php"><?= clean($phpVars) ?></code></pre>
    </section>

    <p>Now use those variables in a prepared statement:</p>

    <section class="code-block">
      <span>using our form data in a prepared statement</span>
      <pre><code class="language-php"><?= clean($usingFormData) ?></code></pre>
    </section>

    <p>We can see from this that prepared statements really aren't too complicated, and that, if you are already familiar with SQL statements, it shouldn't take an enormous amount of effort to get used to constructing them.</p>

    <h3>conclusion</h3>
    <p>PHP has some very powerful features to handle forms and the data they collect. And while that is true, there are some excellent <em>form processing services</em> that will deal with all the complexities of form handling for us. Those are definately worth investingating unless you are intent on using/learning PHP.</p>

    <p>The forms presented to the user must have front end validation performed on them, to ensure that we get the right type of data and also that any <samp>required</samp> fields are not empty. Further back-end validiation should be done on the server, as discussed in this article.</p>

    <p>The form's <samp>action</samp> attribute defines where the data is sent, ultimately to a file that can handle the form data.</p>

    <p>The form's <samp>method</samp> attribute defines how the data is sent to the server i.e. a <samp>$_GET</samp> request, which appends that data to the URL in the browsers' address bar or a <samp>$_POST</samp> method that submits the data in the <samp>body of the request.</samp></p>

    <p>The form data is stored in an associative array consisting of <samp>key->value</samp> pairs, most commonly in the <code>superglobal</code> <samp>$_GET</samp> or <samp>$_POST</samp>. We can access that data using standard <samp>array</samp> methods and bracket notation e.g. <samp>$_POST["keyValueName"]</samp>.</p>

    <p>The data contained within the <code>superglobals</code> should be treated as <em>dangerous</em> as it could contain code that executes XSS (cross-site-scripting) or SQL injection threats.</p>

    <p>If data is to be used in another type of code, HTML, SQL query, JSON string etc. it should be made to comply with the rules of that code type using tools (funtions/methods) that have been built for that purpose. i.e. <samp>htmlspcialchars()</samp> when printing to the browser, <code>prepared statements</code> for including data in an SQL query, <samp>JSON_encode()</samp> to correctly format data in a JSON <samp>string</samp> etc.</p>

    <p>The PDO and MySQLi extensions are available to create prepared statements. There are three steps to create them: prepare, bind and execute. The <code>mysqli</code> method is purely for use with a MySQL database, while PDO can be used for any database engine.</p>

    <p>Making data safe to use is fairly complicated, but, with a little thought and consideration, it can be achieved using pre-existing tools and in general, we should not have to create our own custom code to perform those tasks.</p>

  </article>
</main>

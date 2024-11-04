<main class="container">
  <section>
    <h1><?=$mainTitle?></h1>
    <p>
      This is a place where I write things about php. Hopefully there's some
      stuff that you may find interesting and useful. However, this is not meant
      to be a tutorial, but more of a reference for my future self!
    </p>
  </section>

  <section>
    <h2>So what is PHP?</h2>
    <p>
      Well, PHP is a server side scripting language that is well suited to
      developing websites. It was created by
      <a href="https://en.wikipedia.org/wiki/Rasmus_Lerdorf" target="_blank"
        >Rasmus Lerdorf</a
      >
      who released the first version in 1995. It is now maintained by the
      <a href="https://www.php.net/credits.php" target="_blank">
        PHP development Team</a
      >.
    </p>

    <p>
      PHP allows us to get a bit 'closer to the metal' than front-end languages
      such as JavaScript, and with that, gives us access to the operating
      systems' file architecture. It has great compatibility with numerous
      database engines such as; MySQL, PostgreSQL, MS SQL, db2, Oracle Database,
      and MongoDB, so that we can build fully functional applications, it has
      'built-in' security features, it's fast and fairly easy to learn. Quite
      importantly too, it's extremely well supported, open source (so its free!)
      and is available on most free-hosting solutions. That is the one of the
      reasons I chose to take up the language, rather than focusing purely on
      developing my skills with more modern server side languages such as
      Node.js. I found the free hosting solutions offering Node.js quite
      limiting and not really useful for anything other than 'messing around'.
      Hopefully, that will change in the near future, it certainly should
      because like PHP, Node.js is open source too.
    </p>

    <p>
      In the mean time, PHP, powers most of the Internet, a whopping 78% as of
      2024.
    </p>
  </section>

  <article class="container">
    <h1>
      the
      <code>if</code>
      statement
    </h1>
    <p>
      I'm starting with the <samp>if</samp> statement to demonstrate a few
      things about the <samp>PHP</samp> language, and, when we write computer
      programs, one important aspect is control flow and logic. The
      <samp>if</samp> statement gives us a means to control what is done when a
      certain state of an element evaluates to a certain condition. For
      instance, we could ask the question "is the cookie jar full?" and if it is
      "what are we going to do about it?" We could then control exactly what
      happens in our program by issuing instructions based on the possible
      answer <samp>yes</samp> or <samp>no</samp>, <samp>true</samp> or
      <samp>false</samp>.
    </p>

    <section class="code-block">
      <span>The basic syntax as as follows:</span>
      <pre><code class="language-php"><?=htmlspecialchars($example)?></code></pre>
    </section>

    <p>
      We write <samp>if</samp> followed bay an expression wrapped in parantheses
      <samp>(expression to be evaluated)</samp>. We then wrap our statement to
      be executed in curly braces <samp>{ //statement to be executed }</samp>.
      The curly braces are optional and can be omitted if we only have one
      statement spanning one line, however, it's good practice to always use
      them, as it make the code easier to read.
    </p>

    <p>
      So, in short, the <samp>if</samp> statement is used to check if a
      condition evaluates to <samp>true</samp> or <samp>false</samp>, before
      executing a statement.
    </p>

    <p>
      For example, we could check whether some element in our program should be
      assigned admin rights:
    </p>

    <section class="code-block">
      <span>Check admin rights.</span>
      <pre><code class="language-php"><?=htmlspecialchars($adminTrue)?></code></pre>
      <strong>
        <span>output:</span>
        <div class="output">
          <pre><code class="language-php"><?=htmlspecialchars($output)?></code></pre>
        </div>
      </strong>
    </section>

    <section>
      <p>
        ...well that's all well and good, if our expression evaluates to
        <samp>true</samp>
      </p>

      <p>
        If the condition evaluates to false, we can use an
        <samp>else</samp> statement to execute an alternative action:
      </p>
    </section>

    <section class="code-block">
      <p>Use <samp>else</samp> statement to execute an alternative action:</p>
      <pre><code class="language-php"><?=htmlspecialchars($adminFalse)?></code></pre>
      <strong> <p>output:</p></strong>
      <div class="output">
        <pre><code class="language-php"><?=htmlspecialchars($adminFalseOutput)?></code></pre>
      </div>
    </section>

    <section class="code-block">
      <span>We can also chain <samp>if</samp> statements when we need to:</span>
      <pre><code class="language-php"><?=htmlspecialchars($chainIf)?></code></pre>
    </section>

    <section>
      <p>
        <strong>Note:</strong> In the code above, we had to use different
        variables names <samp>$admin</samp> <samp>$isAdmin</samp> etc. otherwise
        the <samp>$admin</samp> & <samp>$output</samp> values would have been
        incorrect in the first example, as only the last value of
        <samp>$admin</samp> and <samp>$output</samp> would have been used.
      </p>
    </section>

    <section>
      <p>
        Just for your info', we're using live php code for the
        <samp>if</samp> statments above, along with
        <samp>&lt;&lt;&lt;HEREDOC</samp> strings to print the actual code that
        you see above. <samp>&lt;&lt;&lt;HEREDOC</samp>, of course, parses and
        replaces the variable names within the string (e.g. <samp>$admin</samp>)
        with the actual values, hence the reason why we had to use different
        variable names for each example.
      </p>
    </section>

    <section>
      <h2>a deeper dive</h2>
      <p>
        Above, we were just checking whether a variable was set to
        <samp>true</samp> before executing a statement, however, we can also
        test whether a variable is equal to another variable, value or
        expression.
      </p>
      <p>
        For instance, we could check whether the password entered by the user
        matches the password stored in another variable within the program.
      </p>

      <section class="code-block">
        <span>Check variable's value against another variable's value:</span>
        <pre><code class="language-php"><?=htmlspecialchars($passwordEg)?></code></pre>
      </section>
    </section>

    <section>
      <p>
        Check a variable's value matches a specific value, then, check if the
        variable's value is less than a specific value by chaining an
        <samp>elseif</samp> statement before finally chaining an
        <samp>else</samp> statement that does something else if both previous
        checks evaluate to <samp>false</samp>:
      </p>

      <section class="code-block">
        <span>Chaining <samp>elseif</samp> & <samp>else</samp> statements</span>
        <pre><code class="language-php"><?=htmlspecialchars($variableValue)?></code></pre>
      </section>
    </section>

    <section>
      <p>
        So, here we checked if our counter value, (<samp>$counter</samp>), was
        exactly equal to the integer value <samp>10</samp> using the strict
        comparison operator, <samp>===</samp>, when that evaluates to
        <samp>true</samp> we do something appropriate to the counter being full.
        However, if it is not <samp>true</samp>, we check whether our counter's
        value is less than <samp>10</samp> using an
        <samp>elseif</samp> statement before we commit to continue counting. And
        finally, we chain an <samp>else</samp> statement onto the end to catch
        the case where the counter's value is greater than <samp>10</samp>,
        which shouldn't happen in our program!
      </p>

      <h2>a note on the comparison operators</h2>
      <p>
        We can compare values using the comparison operator <samp>==</samp> or
        the strict comparison operator <samp>===</samp>. Its good practice to
        always use the strict comparison operator, as it ensures an 'exact'
        match both in 'value' and 'type of value' which is not alway the case.
      </p>
      <p>
        If we compare two operands, one of which is a string, the other a
        number, the comparison between the two is done numerically. For
        instance: <samp>10 === "10"</samp> evaluates to <samp>false</samp> while
        <samp>10 == "10"</samp> evaluates to <samp>true</samp>. This is due to
        'type juggling' or 'type coercion' which is something
        <samp>PHP</samp> and other languages do for our convenience, but, it is
        also something that can trip us up and introduce bugs to our program.
        So, as a rule of thumb, always check strictly!
      </p>
      <h2>funless fact!</h2>
      <p>
        Be careful when using PHP 8.0 or lower, if a string is compared to a
        number, <strong>or a numeric string</strong>, the <samp>string</samp> is
        converted to a <samp>number</samp> before the comparison is made. This
        can lead to some real head-scratching results if you are not prepared
        for it. See below:
      </p>

      <section class="code-block">
        <span>comparison of strings & numbers</span>
        <pre><code class="language-php"><?=htmlspecialchars($stringsAndNumbers)?></code></pre>
      </section>

      <p>
        Hmmm! Thank goodness they fixed that! If you are writing a program from
        scratch, use the latest stable version of PHP that there is, however,
        sometimes, we are stuck with what the hosting provider makes available
        to us, or, we can be fixing, modifying legacy code written in an older
        version, then we have no choice but to work with the version we have to
        hand.
      </p>

      <p>
        We'll take an indepth look at comparison operators in another article.
      </p>

      <p>
        A common mistake that programmers can make is to use the assignment
        operator <samp>=</samp> instead of a comparison operator. This results
        in a value being assigned rather than checked against. It is such an
        easy mistake to make, as a simple typo', that it's worth adopting a
        policy that ensures this can't happen. This little trick does exactly
        that: <em>Always check a value against a variable's value</em>, not the
        other way round.
      </p>

      <section class="code-block">
        <span>Avoid assignment operator mistake</span>
        <pre><code class="language-php"><?=htmlspecialchars($valueToVariableValue)?></code></pre>
      </section>
      <p>
        Taking this approach will help avoid bugs, which is never a bad thing!
      </p>
    </section>

    <section>
      <h2>beware of floats!</h2>
      <p>
        Unlike integers, calculations using floating point numbers, that is,
        numbers with a decimal point, such as <samp>34.99</samp> can not be 100%
        accurate and therefore, care should be taken when using them in any
        evalutation. See below.
      </p>

      <section class="code-block">
        <span>Floating point numbers are approximated:</span>
        <pre><code class="language-php"><?=htmlspecialchars($floats)?></code></pre>
      </section>

      <p>
        There are methods that you can use, such as rounding, to work around
        this problem, but, we'll discuss that elsewhere! In the mean time you
        can get a little info over at
        <a
          href="https://stackoverflow.com/questions/3726721/php-floating-number-precision"
          target="_blank"
          >stackoverflow</a
        >.
      </p>
    </section>

    <section>
      <h2>the <code>if</code> statement embeded in HTML</h2>
      <p>
        If you need to embed an <samp>if</samp> statement into HTML, it's
        perfectly fine to use the syntax used above, however, PHP has a more
        friendly syntax that allows you to mix it nicely with HTML.
      </p>

      <p>
        The basic syntax for embeding an <samp>if</samp> statement into HTML is
        this:
      </p>

      <section class="code-block">
        <span>Syntax to embed PHP in HTML:</span>
        <pre><code class="language-php"><?=htmlspecialchars($embedBasic)?></code></pre>
      </section>

      <section>
        <p>
          The code below shows a link to start a game again, once the game is
          over. However, remember that it's best practice to keep your PHP logic
          in a separate file. That makes the code far easier to read and
          maintain.
        </p>
      </section>

      <section class="code-block">
        <span>Embeded PHP in HTML:</span>
        <pre><code class="language-php"><?=htmlspecialchars($embed)?></code></pre>
      </section>

      <p>
        Because <samp>$isGameOver</samp> evaluates to true, the
        <em>'Start Again'</em> link is rendered on the web page.
      </p>
    </section>

    <section>
      <h2>a summary of the <code>if</code> statement</h2>

      <ul>
        <li>
          The <samp>if</samp> statement is used to evaluate an expression which,
          if truthy, then an expression, or, multiple expressions are executed.
        </li>

        <li>
          We can chain an <samp>else</samp> statement onto the end of an
          <samp>if</samp> staement. This runs in the case where the expression
          being evaluated is falsy.
        </li>

        <li>
          We can also chain multiple <samp>if</samp> and
          <samp>elseif</samp> statements to make further evaluations of
          additional expressions.
        </li>

        <li>
          When evaluating a variable with a value, remember to always write the
          value first. That will protect your program against accidental
          assignment operator use.
        </li>

        <li>
          Be careful when using floating point numbers. Unexpected results can
          occur due to the accuracy limitations of computers and floating point
          nummbers.
        </li>

        <li>
          And finally, the if statement can be embeded 'as is' within HTML, or,
          we can use the shorter, more friendly syntax.
        </li>
      </ul>

      <p>
        One final, final thing about the <samp>if</samp> statement. There are a
        couple of alteratives to the <samp>if</samp> statement, such as the
        <samp>ternary</samp> and <samp>switch</samp> operators, each with its
        own use-case. However, I'll discuss those both individually in their own
        article.
      </p>
    </section>
  </article>
</main>

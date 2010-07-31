# Croogo Plugin - SyntaxHighlighter

Syntax is a syntax highlighter plugin for the [Croogo CMS][1]. It uses
[SyntaxHighlighter][1] to highlight code found in your pages/posts. Initial
development (i.e., the learning process) was heavily borrowed from Fahad's
Geshi plugin.

## Installation

Install like you would any other Croogo plugin. Then enable the Component Hook
and the Helper Hook.

## Configuration

Configure SyntaxHighlighter under Extensions > SyntaxHighlighter. All
configuration options are those offered by SyntaxHighlighter, found [here][3].

To use the SyntaxHighlighter, add a `<pre>` tag to your page (or whatever tag
you defined in the configuration settings) and add `class="brush:php"` to the
tag. Other languages are supported as documented in [SyntaxHighlighter][3].

## Themes and Languages

The Syntax plugin offers support for all of the themes and languages that
SyntaxHighlighter currently supports:

### Themes

- Default
- Django
- Eclipse
- Emacs
- Fade To Grey
- Midnight
- RDark
- If you add a theme, it will show up under configuration!

### Languages

- ActionScript3
- Bash/shell
- ColdFusion
- C#
- C++
- CSS
- Delphi
- Diff
- Erlang
- Groovy
- JavaScript
- Java
- JavaFX
- Perl
- PHP
- Plain Text
- PowerShell
- Python
- Ruby
- Scala
- SQL
- Visual Basic
- XML

[1]: http://croogo.org
[2]: http://alexgorbatchev.com/SyntaxHighlighter/
[3]: http://alexgorbatchev.com/SyntaxHighlighter/manual/configuration/
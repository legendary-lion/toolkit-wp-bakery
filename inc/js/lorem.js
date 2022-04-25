var placeholder_text = `
<p>In science, if you don't do it, somebody else will. Whereas in art, if Beethoven didn't compose the 'Ninth Symphony,' no one else before or after is going to compose the 'Ninth Symphony' that he composed; no one else is going to paint 'Starry Night' by van Gogh. One of the symptoms of an absence of innovation is the fact that you lose your jobs. Everyone else catches up with you. They can do what you do better than you or cheaper than you. And in a multinational corporate-free market enterprise, it is the company's obligation to take the factory to a place where they can make it more cheaply.</p>

<p>Any time scientists disagree, it's because we have insufficient data. Then we can agree on what kind of data to get; we get the data; and the data solves the problem. Either I'm right, or you're right, or we're both wrong. And we move on. That kind of conflict resolution does not exist in politics or religion. I'm perennially intrigued how people who lead largely evidence-based lives can, in a belief-based part of their mind, be certain that an invisible, divine entity created an entire universe just for us, or that the government is stockpiling space aliens in a secret desert location.</p>

<p>Although I'm not actually embarrassed by this, I tend not to read books that have awesome movies made from them, regardless of how well or badly the movie represented the actual written story. As a citizen, as a public scientist, I can tell you that Einstein essentially overturned a so strongly established paradigm of science, whereas Darwin didn't really overturn a science paradigm. People credit me for making the universe interesting when in fact the universe is inherently interesting, and I'm merely revealing that fact. I don't think I'm anything special for this to happen.</p>

<p>We think scientific literacy flows out of how many science facts can you recite rather than how was your brain wired for thinking. And it's the brain wiring that I'm more interested in rather than the facts that come out of the curriculum or the lesson plan that's been proposed. The universe is hilarious! Like, Venus is 900 degrees. I could tell you it melts lead. But that's not as fun as saying, 'You can cook a pizza on the windowsill in nine seconds.' And next time my fans eat pizza, they're thinking of Venus!</p>

<p>I don't know anybody who said, 'I love that teacher, he or she gave a really good homework set,' or 'Boy, that was the best class I ever took because those exams were awesome.' That's not what people want to talk about. It's not what influences people in one profession or another.</p>
`;
!function($) {
  $('.add-placeholder-text').click(function(e){
    e.preventDefault();
    tinyMCE.activeEditor.focus();
    var myContent = tinymce.activeEditor.getContent();
    var myContent = myContent + placeholder_text;
    tinymce.activeEditor.setContent(myContent);
  });
}(window.jQuery);
function handlePageTemplate(ev) {
  console.log('Context', ev.detail);

  var post = ev.detail.post;
  var template = post.template_name;

  if (globals.is_logged_in) {
    document.editLink.setAttribute(
      'href',
      globals.urls.admin.concat('/post.php?post=' + post.id + '&action=edit'),
    );
  }

  var context = {
    title: post.title.rendered,
    content: post.content.rendered,
    urls: globals.urls,
  };

  console.log('view/' + template);
  switch (template) {
    case 'front-page':
      render('main', [
        getTemplate(
          'hero',
          Object.assign(context, {
            leadin: post.fields.welcome_headline,
            heading: post.fields.welcome_statement,
            featured_heading: post.fields.welcome_featured_title,
            button: post.fields.welcome_cta_button,
          }),
        ),
        getTemplate('case-studies', context),
        getTemplate('featurette', context),
      ]);
      break;
    case 'talents':
      console.log('set talents');
      context.intro_headline = post.fields.intro_headline;
      context.intro_statement = post.fields.intro_statement;
      context.sections = post.fields.sections;
      break;
    case 'contact':
      context.intro_statement = post.fields.intro_statement;
      break;
    default:
      render('main', getTemplate(template, context));
  }

  document.dispatchEvent(new CustomEvent('view/pageReady/' + template));
}

document.addEventListener('view/page', handlePageTemplate);
Object.keys(globals.templates).map(function(template) {
  document.addEventListener('view/' + template, handlePageTemplate);
});

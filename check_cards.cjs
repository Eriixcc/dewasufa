const fs = require('fs');
const html = fs.readFileSync('resources/views/admin/dashboard.blade.php', 'utf8');
const cardMatches = [...html.matchAll(/<div class="dash-recom-card"([^>]*)>/g)];
console.log('Total dash-recom-card found:', cardMatches.length);
cardMatches.forEach((m, i) => {
  const attrs = m[1];
  const cat = attrs.match(/data-category="([^"]*)"/)?.[1];
  const status = attrs.match(/data-status="([^"]*)"/)?.[1];
  const title = attrs.match(/data-title="([^"]*)"/)?.[1];
  console.log(`${i+1}. cat="${cat}" status="${status}" title="${title}"`);
});

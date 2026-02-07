// netlify/functions/getPublicFile.js
let publicFiles = {}; // MUST match savePublicFile.js memory

exports.handler = async (event) => {
  const id = event.queryStringParameters.id;
  if(!id || !publicFiles[id]) {
    return { statusCode: 404, body: JSON.stringify({ error: "File not found" }) };
  }
  return {
    statusCode: 200,
    body: JSON.stringify(publicFiles[id]),
  };
};

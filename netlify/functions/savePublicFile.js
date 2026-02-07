// netlify/functions/savePublicFile.js
let publicFiles = {}; // in-memory store for demo

exports.handler = async (event) => {
  try {
    const { content, fileType } = JSON.parse(event.body);
    if(!content) throw "No content provided";

    // Generate random ID
    const id = Math.random().toString(36).substring(2,10);

    // Save content in memory
    publicFiles[id] = { content, fileType, created: new Date() };

    // Return shareable URL
    const url = `/publicFile.html#${id}`;

    return {
      statusCode: 200,
      body: JSON.stringify({ id, url }),
    };
  } catch (err) {
    return {
      statusCode: 400,
      body: JSON.stringify({ error: err.toString() }),
    };
  }
};

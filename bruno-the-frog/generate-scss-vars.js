const fs = require('fs');

// Read the theme.json file
fs.readFile('./theme.json', 'utf8', (err, data) => {
    if (err) {
        console.error('Error reading theme.json:', err);
        return;
    }

    const theme = JSON.parse(data);
    console.log('Theme JSON:', theme); // Log the entire theme object
    const colors = theme.settings.color.palette;
    const layout = theme.settings.layout;
    const typography = theme.settings.typography.fontSizes;
    const spacingSizes = theme.settings.spacing.spacingSizes || []; // Correctly access spacingSizes

    console.log('Spacing Sizes:', spacingSizes); // Log to inspect

    let scssVariables = '';

    // Generate color variables
    colors.forEach(color => {
        const variableName = `$${color.slug}`;
        scssVariables += `${variableName}: ${color.color}; // ${color.name}\n`;
    });

    // Generate layout variables
    scssVariables += `\n$content-size: ${layout.contentSize}; // Content Size\n`;
    scssVariables += `$wide-size: ${layout.wideSize}; // Wide Size\n`;

    // Generate typography variables
    typography.forEach(fontSize => {
        const variableName = `$${fontSize.slug}`;
        scssVariables += `${variableName}: ${fontSize.size}; // ${fontSize.name}\n`;
    });

    // Generate spacing size variables
    spacingSizes.forEach(size => {
        const variableName = `$spacing-${size.slug}`; // Create a variable name based on slug
        scssVariables += `${variableName}: ${size.size}; // Spacing Size - ${size.name}\n`;
    });

    // Define the output file path
    const outputPath = './scss/_variables.scss'; // Adjust path as needed

    // Write the SCSS variables to the file
    fs.writeFile(outputPath, scssVariables, (err) => {
        if (err) {
            console.error('Error writing SCSS variables:', err);
            return;
        }
        console.log('SCSS variables have been generated in:', outputPath);
    });
});
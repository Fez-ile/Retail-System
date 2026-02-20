# AMMS Image Assets

This folder contains all the image assets for the AMMS luxury retail website.

## Required Images

### Featured Collection Images (Homepage)

These images appear in the 3-column featured collection section on the homepage.

1. **essentials.jpg** (400x400px recommended)
   - Location: Featured Collection section, first card
   - Description: Minimalist image representing everyday essentials
   - Suggested: Clean, editorial product shot or lifestyle image

2. **seasonal.jpg** (400x400px recommended)
   - Location: Featured Collection section, second card
   - Description: Represents limited seasonal collections
   - Suggested: Trendy seasonal collection showcase

3. **capsule.jpg** (400x400px recommended)
   - Location: Featured Collection section, third card
   - Description: Shows capsule wardrobe pieces
   - Suggested: Coordinated outfit pieces that work together

### Campaign Image

4. **campaign.jpg** (500x600px recommended)
   - Location: "Redefining Modern Elegance" section on homepage
   - Description: Editorial campaign image
   - Suggested: High-quality product or lifestyle photography

### About Page Image

5. **about-hero.jpg** (1200x800px recommended)
   - Location: About page hero section (behind the "AMMS" text)
   - Description: Brand story visual
   - Suggested: Lifestyle image, brand photography, or product composition

---

## Image Requirements

### Best Practices

- **Format**: JPG or PNG (JPG preferred for photos, PNG for graphics)
- **Optimization**: Compress images to reduce file size
- **Resolution**: Use high-resolution images (2x or 3x for crisp display)
- **Aspect Ratios**:
  - Featured cards: Square (1:1)
  - Campaign: Portrait (5:6)
  - About hero: Landscape (3:2)

### Recommended File Sizes

- Featured images: 50-150 KB each
- Campaign image: 100-200 KB
- About hero: 150-300 KB
- Total: Keep under 1 MB for good performance

### Styling Tips

Since AMMS is a luxury brand with minimalist aesthetic:

- Use clean, professional photography
- Prefer neutral backgrounds (white, beige, grey)
- High contrast and sharp focus
- Minimal text overlays
- Edit for a cohesive black and white or monochromatic feel
- Ensure consistent lighting and tone

---

## How to Add Images

### Step 1: Prepare Your Images

1. Choose or create your images
2. Resize to recommended dimensions
3. Optimize for web (compress)
4. Save as JPG or PNG

### Step 2: Upload to Server

1. Save images to this folder: `assets/images/`
2. Use the exact filenames listed above:
   - essentials.jpg
   - seasonal.jpg
   - capsule.jpg
   - campaign.jpg
   - about-hero.jpg

### Step 3: Verify Display

1. Open the website in a browser
2. Check homepage for featured images
3. Check campaign section for the image
4. Check About page for hero image
5. All images should display correctly

### Step 4: Mobile Testing

- Test on mobile devices
- Verify images scale properly
- Check image loading speed

---

## Backup Images (Fallback)

If an image is missing, the website will show:

- An error or broken image indicator
- CSS background color instead

To ensure images always display:

1. Double-check filenames are correct
2. Verify files are in the correct folder
3. Check image permissions (should be readable)
4. Ensure browser cache is cleared (Ctrl+Shift+Del)

---

## Image Editing Tools

### Free Online Tools

- **Canva**: Create professional designs
- **Unsplash/Pexels**: Download free high-quality photos
- **TinyPNG**: Compress PNG images
- **JPEGmini**: Compress JPEG images
- **Photoshop** (paid): Professional image editing

### Recommended Dimensions for Editing

1. **essentials.jpg**: 400x400 px
2. **seasonal.jpg**: 400x400 px
3. **capsule.jpg**: 400x400 px
4. **campaign.jpg**: 500x600 px (5:6 aspect ratio)
5. **about-hero.jpg**: 1200x800 px (3:2 aspect ratio)

---

## Display Locations Reference

### Homepage (index.php)

- Featured Collection: 3 images shown in equal columns
  - Essentials (top-left)
  - Seasonal (top-center)
  - Capsule (top-right)
- Campaign Section: 1 large image on left, text on right
  - Campaign image (500x600px)

### About Page (about.php)

- Hero Banner: Full-width image behind "AMMS" text
  - About hero image (shown at reduced opacity)
  - Best viewed full-width

---

## Tips for Professional Results

1. **Consistency**: Use a consistent aesthetic across all images
2. **Lighting**: Ensure consistent lighting and color temperature
3. **Composition**: Follow the rule of thirds in your framing
4. **Colors**: Stick to the brand colors (black, white, beige, grey tones)
5. **Quality**: Avoid pixelation or blur
6. **Branding**: Consider adding subtle watermarks or branding
7. **SEO**: Use descriptive alt text (already included in code)

---

## File Management

### Current Folder Structure

```
c:\xampp\htdocs\Retail system\
├── assets/
│   └── images/
│       ├── README.md (this file)
│       ├── essentials.jpg
│       ├── seasonal.jpg
│       ├── capsule.jpg
│       ├── campaign.jpg
│       └── about-hero.jpg
```

### How to Organize

- Keep all images in `assets/images/` folder
- Use lowercase filenames with hyphens
- Don't rename files (web code references specific names)
- Keep backup copies elsewhere

---

## Troubleshooting

### Images Not Showing

**Problem**: Images appear as broken links
**Solution**:

1. Verify filename spelling matches exactly
2. Check file extension (.jpg or .png)
3. Ensure file is in correct folder
4. Clear browser cache

### Images Look Blurry

**Problem**: Images appear pixelated
**Solution**:

1. Use higher resolution source image
2. Don't scale image larger than original
3. Ensure file isn't corrupted
4. Re-compress if needed

### Images Too Large (Slow Loading)

**Problem**: Page takes too long to load
**Solution**:

1. Compress images more aggressively
2. Use online compression tools
3. Reduce image dimensions
4. Convert PNG to JPG if possible

---

## Contact & Support

For questions about image specifications or placement, refer to the DESIGN_GUIDE.md file in the root directory.

**Image Assets Updated**: February 17, 2026

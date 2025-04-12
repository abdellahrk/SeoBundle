# Changelog
[1.0.7] - 2023-05-11
### Added
- Google Tag
- Open Graph Structured objects -Profile and Book

[1.0.7] - 2023-05-11
### Added
- OG Audio
- OG Video
- OG Image
- OG Article

### Added 
-   OG Image OpenGraph Structure Property
-   OpenGraphManager and OGImageManager

### Changed
- OpenGraph to OpenGraphManager
- Refactored base opengraph to use an Object with typed properties

[1.0.6] - 2025-05-10
### Fixed
- Remove unpack variable causing a bug at viewport assignment

[1.0.5] - 2025-05-09

### Added 
-   Possibility to set Meta Tags in Twig templates

### Fixed 
-   Fixed inconsistencies in Open Graph parameters in container
  - Fixed sitemap generation via CLI

### Removed
- Sitemap's frequency parameter from container [scheduler component not being used]

[1.0.4] - 2025-05-09

### Added
-   SEO profiler to give information about the different SEO being used [WIP]

### Changed

-   Updated the Meta Tags storage from an array to an object

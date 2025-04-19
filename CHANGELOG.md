# Changelog

## [1.0.10] - 2025-04-19
### Added
- Meta Pixel

### Changed
- Refactored some namespaces

## [1.0.9] - 2025-04-17
### Added
- Schema rendering through eventsubscriber
- Config to enable Schema rendring

### Changed
- Removed schema_org twig tag
- Enhanced the readme

## [1.0.8] - 2025-04-11
### Added
- Google Tag
- Open Graph Structured objects -Profile and Book

## [1.0.7] - 2025-04-11
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

## [1.0.6] - 2025-04-10
### Fixed
- Remove unpack variable causing a bug at viewport assignment

## [1.0.5] - 2025-04-09

### Added 
-   Possibility to set Meta Tags in Twig templates

### Fixed 
-   Fixed inconsistencies in Open Graph parameters in container
  - Fixed sitemap generation via CLI

### Removed
- Sitemap's frequency parameter from container [scheduler component not being used]

## [1.0.4] - 2025-04-09

### Added
-   SEO profiler to give information about the different SEO being used [WIP]

### Changed

-   Updated the Meta Tags storage from an array to an object

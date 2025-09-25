# Contributing to TrueNorthNews

Thank you for your interest in contributing to TrueNorthNews! This document provides guidelines and information for contributors.

## 🤝 How to Contribute

### Reporting Issues

-   Use GitHub Issues to report bugs
-   Include detailed steps to reproduce
-   Provide your environment details (PHP version, OS, etc.)
-   Include screenshots for UI issues

### Suggesting Features

-   Open a GitHub Issue with the "enhancement" label
-   Clearly describe the feature and its benefits
-   Provide mockups or examples if applicable

### Code Contributions

1. **Fork the repository**

    ```bash
    git fork https://github.com/omarashrafali498/truenorthnews.git
    ```

2. **Create a feature branch**

    ```bash
    git checkout -b feature/your-feature-name
    ```

3. **Make your changes**

    - Follow PSR-12 coding standards
    - Add tests for new functionality
    - Update documentation as needed

4. **Test your changes**

    ```bash
    php artisan test
    ```

5. **Commit your changes**

    ```bash
    git commit -m "Add: brief description of changes"
    ```

6. **Push to your fork**

    ```bash
    git push origin feature/your-feature-name
    ```

7. **Create a Pull Request**
    - Provide a clear description of changes
    - Reference any related issues
    - Include screenshots for UI changes

## 🎯 Development Guidelines

### Code Style

-   Follow PSR-12 coding standards
-   Use meaningful variable and function names
-   Add comments for complex logic
-   Keep functions small and focused

### Commit Messages

Use conventional commit format:

-   `feat:` for new features
-   `fix:` for bug fixes
-   `docs:` for documentation updates
-   `style:` for formatting changes
-   `refactor:` for code improvements
-   `test:` for adding tests

### Testing

-   Write tests for new features
-   Ensure all tests pass before submitting
-   Test on multiple browsers for UI changes

### Database Changes

-   Create migrations for schema changes
-   Update seeders if needed
-   Test migrations on fresh database

## 🚀 Development Setup

1. **Clone your fork**

    ```bash
    git clone https://github.com/omarashrafali498/truenorthnews.git
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Set up environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run migrations**

    ```bash
    php artisan migrate --seed
    ```

5. **Start development server**
    ```bash
    php artisan serve
    ```

## 📋 Pull Request Checklist

-   [ ] Code follows PSR-12 standards
-   [ ] Tests are added/updated and passing
-   [ ] Documentation is updated
-   [ ] No merge conflicts
-   [ ] Feature works across browsers
-   [ ] Mobile responsive (if UI changes)
-   [ ] Database migrations tested

## 🎯 Areas for Contribution

### High Priority

-   Performance optimizations
-   Security improvements
-   Test coverage improvements
-   API development

### Medium Priority

-   UI/UX enhancements
-   New features
-   Documentation improvements
-   Code refactoring

### Good First Issues

-   Bug fixes
-   Documentation updates
-   UI polishing
-   Adding tests

## 💬 Getting Help

-   Join our discussions in GitHub Discussions
-   Ask questions in Issues (with "question" label)
-   Review existing documentation first

## 🏆 Recognition

Contributors will be:

-   Listed in the README
-   Mentioned in release notes
-   Invited to be maintainers (for significant contributions)

## 📄 License

By contributing, you agree that your contributions will be licensed under the MIT License.

Thank you for making TrueNorthNews better! 🚀

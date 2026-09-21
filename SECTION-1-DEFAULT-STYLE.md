# Section 1 default style

Use this pattern for standard split-content sections such as About and Why Choose Us.

## Structure

- Keep the section on the paper background: `var(--kcid-paper)`.
- Use a `.design-wide` wrapper for the shared page width.
- Use a two-column grid with a flexible 605px content column, a flexible media column, and a responsive gap.
- Vertically center the columns and use `padding-block: var(--kcid-section-space)`.
- Use a rounded media frame with `var(--kcid-radius)` and a fixed desktop height around `441px`.

## Typography and colour

- Use Poppins for the main heading, `font-weight: 700`, `line-height: 1.12`, and a large desktop size around `2.8rem`.
- Split the heading into two spans: the lead uses `var(--kcid-black)` and the accent uses `var(--kcid-pink)`.
- Use `var(--kcid-muted)` for supporting copy, with the shared section-copy size and line-height tokens.
- Do not add a script-style kicker unless a section specifically needs one.

## CTA

- Use a yellow pill CTA: `var(--kcid-yellow)` with `var(--kcid-black)` text.
- Use a pink circular arrow icon at the right of the pill.
- Keep the CTA compact, with `border-radius: 999px`, a small shadow, and the existing hover transition to `var(--kcid-yellow-deep)`.

## Responsive behaviour

- Collapse to one column at the existing tablet breakpoint.
- Keep the media below the text on small screens.
- Remove content transforms and keep the same spacing rhythm on mobile.

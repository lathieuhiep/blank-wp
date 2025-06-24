    </main><!-- close main.main-content -->

    <?php if ( !is_404() ) : ?>
        <footer>
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> - <?php bloginfo('name'); ?></p>
            </div>
        </footer>
    <?php endif; ?>
</div> <!-- close div.page-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
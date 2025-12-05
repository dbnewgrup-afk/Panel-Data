-- ===========================================
-- SEED DATA PANEL-DATA
-- ===========================================

-- Insert user default
INSERT INTO users (name, email, password, created_at)
VALUES (
    'Administrator',
    'admin@example.com',
    -- password = admin123
    '$2y$10$3fsgOwRs4um7/MJv2ItPxOBiBlnUBu91vE7jBsxlwKkUEF/S9CQHi',
    NOW()
);

-- Insert default settings (NO updated_at column)
INSERT INTO settings (`key`, `value`) VALUES
('digiflazz_api_key', ''),
('digiflazz_signature', ''),
('tokoku_client_id', ''),
('tokoku_client_secret', ''),
('tokoku_api_url', ''),
('webhook_url', ''),
('app_name', 'Panel Data'),
('app_logo', ''),
('last_update', '');

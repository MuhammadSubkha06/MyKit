-- ============================================
-- MYKIT DATABASE
-- PostgreSQL / Supabase
-- ============================================

DROP TABLE IF EXISTS logs CASCADE;
DROP TABLE IF EXISTS cycles CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- ============================================
-- USERS
-- ============================================

CREATE TABLE users
(
    id BIGSERIAL PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(150) NOT NULL UNIQUE,

    password TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_users_email
ON users(email);

-- ============================================
-- CYCLES
-- ============================================

CREATE TABLE cycles
(
    id BIGSERIAL PRIMARY KEY,

    user_id BIGINT NOT NULL,

    start_date DATE NOT NULL,

    cycle_length INTEGER NOT NULL DEFAULT 28,

    period_length INTEGER NOT NULL DEFAULT 5,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_cycle_user
    FOREIGN KEY(user_id)

    REFERENCES users(id)

    ON DELETE CASCADE
);

CREATE INDEX idx_cycles_user
ON cycles(user_id);

CREATE INDEX idx_cycles_start
ON cycles(start_date);

-- ============================================
-- LOGS
-- ============================================

CREATE TABLE logs
(
    id BIGSERIAL PRIMARY KEY,

    cycle_id BIGINT NOT NULL,

    log_date DATE NOT NULL,

    mood VARCHAR(50),

    symptoms JSONB DEFAULT '[]',

    notes TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_log_cycle

    FOREIGN KEY(cycle_id)

    REFERENCES cycles(id)

    ON DELETE CASCADE
);

CREATE INDEX idx_logs_cycle
ON logs(cycle_id);

CREATE INDEX idx_logs_date
ON logs(log_date);

CREATE INDEX idx_logs_mood
ON logs(mood);